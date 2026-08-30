import React, { useState } from 'react';
import { ShoppingItem } from '../types';
import { X, Trash2, Plus, Minus, Check, Copy, Share2, Sparkles, Store, ExternalLink } from 'lucide-react';

interface ShoppingListDrawerProps {
  isOpen: boolean;
  onClose: () => void;
  shoppingList: ShoppingItem[];
  onUpdateQuantity: (dealId: string, quantity: number) => void;
  onRemoveItem: (dealId: string) => void;
  onClearList: () => void;
}

export const ShoppingListDrawer: React.FC<ShoppingListDrawerProps> = ({
  isOpen,
  onClose,
  shoppingList,
  onUpdateQuantity,
  onRemoveItem,
  onClearList,
}) => {
  const [checkedIds, setCheckedIds] = useState<Record<string, boolean>>({});
  const [copySuccess, setCopySuccess] = useState(false);

  if (!isOpen) return null;

  const toggleCheck = (id: string) => {
    setCheckedIds((prev) => ({ ...prev, [id]: !prev[id] }));
  };

  const totalPrice = shoppingList.reduce(
    (acc, item) => acc + item.deal.currentPrice * item.quantity,
    0
  );

  const totalOriginalPrice = shoppingList.reduce(
    (acc, item) => acc + item.deal.originalPrice * item.quantity,
    0
  );

  const totalSavings = totalOriginalPrice - totalPrice;
  const savingsPercent = totalOriginalPrice > 0 ? Math.round((totalSavings / totalOriginalPrice) * 100) : 0;

  // Group items by store for easy shopping trips
  const itemsByStore: Record<string, ShoppingItem[]> = {};
  shoppingList.forEach((item) => {
    const store = item.deal.store;
    if (!itemsByStore[store]) {
      itemsByStore[store] = [];
    }
    itemsByStore[store].push(item);
  });

  const handleCopyList = () => {
    let text = `🛒 MIN INDKØBSLISTE (UGENS TILBUD)\n`;
    text += `------------------------------------\n`;
    Object.entries(itemsByStore).forEach(([store, items]) => {
      text += `\n📍 ${store.toUpperCase()}:\n`;
      items.forEach((item) => {
        text += `- ${item.quantity}x ${item.deal.name} (${item.deal.variant}) - ${(item.deal.currentPrice * item.quantity).toFixed(2)} kr (Spar ${(item.deal.discountAmount * item.quantity).toFixed(2)} kr)\n`;
      });
    });
    text += `\n------------------------------------\n`;
    text += `💵 Samlet pris: ${totalPrice.toFixed(2)} kr.\n`;
    text += `🎉 Samlet besparelse: ${totalSavings.toFixed(2)} kr. (${savingsPercent}% rabat)\n`;

    navigator.clipboard.writeText(text);
    setCopySuccess(true);
    setTimeout(() => setCopySuccess(false), 2500);
  };

  return (
    <div className="fixed inset-0 z-50 overflow-hidden">
      {/* Backdrop */}
      <div
        className="absolute inset-0 bg-slate-900/60 backdrop-blur-xs transition-opacity"
        onClick={onClose}
      />

      <div className="fixed inset-y-0 right-0 max-w-full flex pl-10">
        <div className="w-screen max-w-md bg-white shadow-2xl flex flex-col">
          
          {/* Drawer Header */}
          <div className="p-5 border-b border-slate-200 flex items-center justify-between bg-slate-50">
            <div>
              <h2 className="text-lg font-bold text-slate-900">
                Din Tilbuds-Indkøbsliste
              </h2>
              <p className="text-xs text-slate-500">
                {shoppingList.length} {shoppingList.length === 1 ? 'vare' : 'forskellige varer'} tilføjet
              </p>
            </div>
            <button
              onClick={onClose}
              className="p-2 text-slate-400 hover:text-slate-600 rounded-lg hover:bg-slate-200 transition-colors"
            >
              <X className="w-5 h-5" />
            </button>
          </div>

          {/* Savings banner in drawer */}
          {shoppingList.length > 0 && (
            <div className="bg-emerald-600 text-white p-4 mx-4 mt-4 rounded-xl shadow-xs">
              <div className="flex items-center justify-between">
                <div>
                  <div className="text-xs font-medium text-emerald-100 uppercase tracking-wider flex items-center gap-1">
                    <Sparkles className="w-3.5 h-3.5 text-amber-300" />
                    Samlet besparelse
                  </div>
                  <div className="text-2xl font-black text-white mt-0.5">
                    {totalSavings.toFixed(2).replace('.', ',')} kr.
                  </div>
                </div>
                <div className="text-right">
                  <div className="text-xs font-semibold bg-emerald-700/80 px-2.5 py-1 rounded-lg">
                    Spar {savingsPercent}% i alt
                  </div>
                  <div className="text-xs text-emerald-100 mt-1">
                    Total: {totalPrice.toFixed(2).replace('.', ',')} kr.
                  </div>
                </div>
              </div>
            </div>
          )}

          {/* Drawer Body - Items Grouped By Store */}
          <div className="flex-1 overflow-y-auto p-4 space-y-6">
            {shoppingList.length === 0 ? (
              <div className="text-center py-16 px-4">
                <div className="w-16 h-16 bg-slate-100 text-slate-400 rounded-2xl flex items-center justify-center mx-auto mb-4">
                  <ShoppingItemIcon />
                </div>
                <h3 className="text-base font-bold text-slate-800">
                  Din liste er tom
                </h3>
                <p className="text-xs text-slate-500 mt-1 max-w-xs mx-auto">
                  Tryk på &quot;Køb / Gem&quot; på tilbuddene i oversigten for at beregne dine besparelser.
                </p>
              </div>
            ) : (
              Object.entries(itemsByStore).map(([store, items]) => {
                const storeTotal = items.reduce(
                  (acc, item) => acc + item.deal.currentPrice * item.quantity,
                  0
                );
                return (
                  <div key={store} className="bg-slate-50/80 rounded-xl p-3.5 border border-slate-200/80">
                    
                    {/* Store Title */}
                    <div className="flex items-center justify-between pb-2 mb-2 border-b border-slate-200">
                      <div className="flex items-center gap-2">
                        <Store className="w-4 h-4 text-slate-600" />
                        <span className="font-bold text-sm text-slate-900">
                          {store}
                        </span>
                        <span className="text-xs bg-slate-200 text-slate-700 px-2 py-0.5 rounded-full font-medium">
                          {items.length} {items.length === 1 ? 'vare' : 'varer'}
                        </span>
                      </div>
                      <span className="text-xs font-bold text-slate-700">
                        {storeTotal.toFixed(2).replace('.', ',')} kr.
                      </span>
                    </div>

                    {/* Store Items List */}
                    <div className="space-y-2.5">
                      {items.map((item) => {
                        const isChecked = checkedIds[item.deal.id] || false;
                        const lineTotal = item.deal.currentPrice * item.quantity;
                        const lineSavings = item.deal.discountAmount * item.quantity;

                        return (
                          <div
                            key={item.deal.id}
                            className={`p-2.5 rounded-lg bg-white border transition-all ${
                              isChecked
                                ? 'border-slate-200 bg-slate-50/60 opacity-60'
                                : 'border-slate-200/80 shadow-xs'
                            }`}
                          >
                            <div className="flex items-start gap-2.5">
                              {/* Checkbox */}
                              <button
                                onClick={() => toggleCheck(item.deal.id)}
                                className={`mt-0.5 w-5 h-5 rounded-md border flex items-center justify-center shrink-0 transition-colors ${
                                  isChecked
                                    ? 'bg-emerald-600 border-emerald-600 text-white'
                                    : 'border-slate-300 hover:border-slate-400 bg-white'
                                }`}
                              >
                                {isChecked && <Check className="w-3.5 h-3.5 stroke-[3]" />}
                              </button>

                              {/* Info */}
                              <div className="flex-1 min-w-0">
                                <div className={`text-xs font-bold text-slate-900 truncate ${isChecked ? 'line-through text-slate-400' : ''}`}>
                                  {item.deal.name}
                                </div>
                                <div className="text-[11px] text-slate-500 truncate">
                                  {item.deal.variant}
                                </div>
                                <div className="flex items-center gap-2 mt-1">
                                  <span className="text-xs font-extrabold text-emerald-800">
                                    {lineTotal.toFixed(2).replace('.', ',')} kr.
                                  </span>
                                  <span className="text-[10px] text-rose-700 font-semibold bg-rose-50 px-1.5 py-0.5 rounded">
                                    Spar {lineSavings.toFixed(2).replace('.', ',')} kr.
                                  </span>
                                </div>
                              </div>

                              {/* Quantity Stepper & Remove */}
                              <div className="flex items-center gap-1 shrink-0">
                                <button
                                  onClick={() => onUpdateQuantity(item.deal.id, item.quantity - 1)}
                                  className="w-6 h-6 rounded bg-slate-100 hover:bg-slate-200 text-slate-700 flex items-center justify-center text-xs font-bold"
                                >
                                  <Minus className="w-3 h-3" />
                                </button>
                                <span className="w-6 text-center text-xs font-bold text-slate-800">
                                  {item.quantity}
                                </span>
                                <button
                                  onClick={() => onUpdateQuantity(item.deal.id, item.quantity + 1)}
                                  className="w-6 h-6 rounded bg-slate-100 hover:bg-slate-200 text-slate-700 flex items-center justify-center text-xs font-bold"
                                >
                                  <Plus className="w-3 h-3" />
                                </button>
                                <button
                                  onClick={() => onRemoveItem(item.deal.id)}
                                  className="ml-1 text-slate-400 hover:text-rose-600 p-1"
                                  title="Fjern fra liste"
                                >
                                  <Trash2 className="w-3.5 h-3.5" />
                                </button>
                              </div>
                            </div>
                          </div>
                        );
                      })}
                    </div>

                  </div>
                );
              })
            )}
          </div>

          {/* Drawer Footer Actions */}
          {shoppingList.length > 0 && (
            <div className="p-4 border-t border-slate-200 bg-slate-50 space-y-2">
              <div className="flex items-center justify-between text-sm mb-2">
                <span className="font-semibold text-slate-600">Total at betale:</span>
                <span className="font-extrabold text-slate-900 text-lg">
                  {totalPrice.toFixed(2).replace('.', ',')} kr.
                </span>
              </div>

              <div className="grid grid-cols-2 gap-2">
                <button
                  id="copy-shopping-list-button"
                  onClick={handleCopyList}
                  className="inline-flex items-center justify-center gap-1.5 px-3 py-2.5 text-xs font-semibold text-slate-800 bg-white border border-slate-300 hover:bg-slate-100 rounded-xl transition-all shadow-xs"
                >
                  {copySuccess ? (
                    <>
                      <Check className="w-4 h-4 text-emerald-600" />
                      <span className="text-emerald-700">Kopieret!</span>
                    </>
                  ) : (
                    <>
                      <Copy className="w-4 h-4 text-slate-600" />
                      <span>Kopier liste</span>
                    </>
                  )}
                </button>

                <button
                  id="clear-shopping-list-button"
                  onClick={onClearList}
                  className="inline-flex items-center justify-center gap-1.5 px-3 py-2.5 text-xs font-semibold text-rose-700 bg-rose-50 hover:bg-rose-100 border border-rose-200 rounded-xl transition-all"
                >
                  <Trash2 className="w-4 h-4" />
                  <span>Tøm liste</span>
                </button>
              </div>
            </div>
          )}

        </div>
      </div>
    </div>
  );
};

function ShoppingItemIcon() {
  return (
    <svg className="w-8 h-8 stroke-current" fill="none" viewBox="0 0 24 24" stroke="currentColor">
      <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="1.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
    </svg>
  );
}
