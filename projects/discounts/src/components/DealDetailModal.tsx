import React from 'react';
import { Deal } from '../types';
import { X, ExternalLink, Sparkles, Clock, AlertTriangle, ShieldCheck, Tag, ShoppingBag } from 'lucide-react';

interface DealDetailModalProps {
  deal: Deal | null;
  onClose: () => void;
  onToggleShoppingList: (deal: Deal) => void;
  isInShoppingList: boolean;
}

export const DealDetailModal: React.FC<DealDetailModalProps> = ({
  deal,
  onClose,
  onToggleShoppingList,
  isInShoppingList,
}) => {
  if (!deal) return null;

  const formattedPrice = deal.currentPrice.toFixed(2).replace('.', ',');
  const formattedOriginalPrice = deal.originalPrice.toFixed(2).replace('.', ',');
  const formattedDiscountAmount = deal.discountAmount.toFixed(2).replace('.', ',');

  return (
    <div className="fixed inset-0 z-50 overflow-y-auto flex items-center justify-center p-4 sm:p-6">
      {/* Backdrop */}
      <div
        className="fixed inset-0 bg-slate-950/70 backdrop-blur-xs transition-opacity"
        onClick={onClose}
      />

      {/* Modal Content */}
      <div className="relative bg-white rounded-3xl max-w-xl w-full shadow-2xl border border-slate-200 overflow-hidden z-10 animate-in fade-in zoom-in-95 duration-150">
        
        {/* Close Button */}
        <button
          onClick={onClose}
          className="absolute top-4 right-4 z-20 w-9 h-9 rounded-full bg-slate-900/60 hover:bg-slate-900 text-white flex items-center justify-center transition-colors"
        >
          <X className="w-5 h-5" />
        </button>

        {/* Hero Image */}
        <div className="relative h-64 sm:h-72 bg-slate-100">
          <img
            src={deal.imageUrl}
            alt={deal.name}
            className="w-full h-full object-cover"
            referrerPolicy="no-referrer"
          />
          <div className="absolute inset-0 bg-gradient-to-t from-slate-950/80 via-transparent to-transparent" />
          
          <div className="absolute bottom-4 left-5 right-5 flex items-end justify-between">
            <div>
              <span
                className="px-3 py-1 text-xs font-bold text-white rounded-lg shadow-md inline-block mb-2"
                style={{ backgroundColor: deal.storeColor }}
              >
                {deal.store}
              </span>
              <h2 className="text-xl sm:text-2xl font-black text-white">
                {deal.name}
              </h2>
            </div>
            <div className="bg-rose-600 text-white px-3 py-1.5 rounded-xl font-black text-sm shadow-md">
              -{deal.discountPercent}%
            </div>
          </div>
        </div>

        {/* Details Body */}
        <div className="p-6 space-y-5">
          
          {/* Price & Savings Highlight */}
          <div className="bg-slate-50 border border-slate-200/80 rounded-2xl p-4 flex items-center justify-between">
            <div>
              <span className="text-xs font-semibold text-slate-500 uppercase tracking-wider block">
                Tilbudspris
              </span>
              <div className="text-3xl font-black text-slate-900">
                {formattedPrice} <span className="text-base font-bold text-slate-700">kr.</span>
              </div>
            </div>

            <div className="text-right">
              <div className="text-xs font-bold text-rose-700 bg-rose-100/70 border border-rose-200 px-2.5 py-1 rounded-lg">
                Du sparer {formattedDiscountAmount} kr.
              </div>
              <div className="text-xs text-slate-400 line-through mt-1">
                Normalpris {formattedOriginalPrice} kr.
              </div>
            </div>
          </div>

          {/* Description & specs */}
          {deal.description && (
            <p className="text-sm text-slate-600 leading-relaxed">
              {deal.description}
            </p>
          )}

          {/* Grid of Key Product Data */}
          <div className="grid grid-cols-2 gap-3 text-xs">
            <div className="bg-slate-50 p-3 rounded-xl border border-slate-100">
              <span className="text-slate-400 font-medium block">Vægt / Mængde</span>
              <span className="font-bold text-slate-800 text-sm mt-0.5 block">{deal.variant}</span>
            </div>
            <div className="bg-slate-50 p-3 rounded-xl border border-slate-100">
              <span className="text-slate-400 font-medium block">Enhedspris</span>
              <span className="font-bold text-slate-800 text-sm mt-0.5 block">{deal.unitPrice}</span>
            </div>
            <div className="bg-slate-50 p-3 rounded-xl border border-slate-100">
              <span className="text-slate-400 font-medium block">Tilbudsperiode</span>
              <span className="font-bold text-slate-800 text-sm mt-0.5 block">{deal.validUntilText}</span>
            </div>
            <div className="bg-slate-50 p-3 rounded-xl border border-slate-100">
              <span className="text-slate-400 font-medium block">Resterende tid</span>
              <span className="font-bold text-emerald-800 text-sm mt-0.5 block">{deal.daysRemaining} dage tilbage</span>
            </div>
          </div>

          {/* Limitation Warning */}
          {deal.limitText && (
            <div className="flex items-center gap-2 text-xs font-semibold text-amber-900 bg-amber-50 border border-amber-200/80 p-3 rounded-xl">
              <AlertTriangle className="w-4 h-4 text-amber-600 shrink-0" />
              <span>{deal.limitText}</span>
            </div>
          )}

          {/* Actions */}
          <div className="grid grid-cols-1 sm:grid-cols-2 gap-3 pt-2">
            <a
              href={deal.tilbudsavisUrl}
              target="_blank"
              rel="noopener noreferrer"
              className="inline-flex items-center justify-center gap-2 py-3 px-4 rounded-xl text-xs font-bold text-slate-800 bg-slate-100 hover:bg-slate-200 transition-colors"
            >
              <span>Se i tilbudsavis hos {deal.store}</span>
              <ExternalLink className="w-4 h-4 text-slate-500" />
            </a>

            <button
              onClick={() => onToggleShoppingList(deal)}
              className={`inline-flex items-center justify-center gap-2 py-3 px-4 rounded-xl text-xs font-bold transition-all ${
                isInShoppingList
                  ? 'bg-emerald-700 text-white hover:bg-emerald-800'
                  : 'bg-emerald-600 text-white hover:bg-emerald-700 shadow-sm'
              }`}
            >
              <ShoppingBag className="w-4 h-4" />
              <span>{isInShoppingList ? 'Fjern fra indkøbsliste' : 'Tilføj til indkøbsliste'}</span>
            </button>
          </div>

        </div>

      </div>
    </div>
  );
};
