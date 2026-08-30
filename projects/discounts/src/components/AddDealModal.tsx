import React, { useState } from 'react';
import { Deal, Category, StoreName } from '../types';
import { X, Plus, Sparkles, AlertCircle } from 'lucide-react';

interface AddDealModalProps {
  isOpen: boolean;
  onClose: () => void;
  onAddDeal: (deal: Deal) => void;
}

export const AddDealModal: React.FC<AddDealModalProps> = ({
  isOpen,
  onClose,
  onAddDeal,
}) => {
  const [name, setName] = useState('');
  const [brand, setBrand] = useState('');
  const [variant, setVariant] = useState('');
  const [category, setCategory] = useState<Category>('slik_chokolade');
  const [store, setStore] = useState<StoreName>('Netto');
  const [currentPrice, setCurrentPrice] = useState('15.00');
  const [originalPrice, setOriginalPrice] = useState('29.95');
  const [unitPrice, setUnitPrice] = useState('75,00 kr./kg');
  const [validUntilText, setValidUntilText] = useState('Gælder t.o.m. fredag 21. aug');
  const [daysRemaining, setDaysRemaining] = useState('5');
  const [limitText, setLimitText] = useState('Maks. 6 stk. pr. kunde');
  const [tilbudsavisUrl, setTilbudsavisUrl] = useState('https://netto.dk/aviser/');
  const [imageUrl, setImageUrl] = useState(
    'https://images.unsplash.com/photo-1548907040-4baa42d10919?w=600&auto=format&fit=crop&q=80'
  );
  const [badge, setBadge] = useState('Ugens Kup');

  if (!isOpen) return null;

  const getStoreColor = (s: StoreName) => {
    switch (s) {
      case 'Netto':
        return '#d97706';
      case 'Rema 1000':
        return '#00529b';
      case 'Bilka':
        return '#0072ce';
      case 'Lidl':
        return '#0050aa';
      case 'Coop 365':
        return '#00a352';
      case 'Meny':
        return '#ba0c2f';
      default:
        return '#059669';
    }
  };

  const handleSubmit = (e: React.FormEvent) => {
    e.preventDefault();
    const curr = parseFloat(currentPrice) || 10;
    const orig = parseFloat(originalPrice) || 20;
    const discount = Math.max(0, orig - curr);
    const percent = orig > 0 ? Math.round((discount / orig) * 100) : 0;

    const newDeal: Deal = {
      id: 'custom-' + Date.now(),
      name: name || 'Nyt Tilbud',
      brand: brand || 'Mærkevare',
      variant: variant || '1 stk.',
      category,
      store,
      storeColor: getStoreColor(store),
      storeBg: 'bg-slate-100 text-slate-800',
      currentPrice: curr,
      originalPrice: orig,
      unitPrice: unitPrice || '10,00 kr./stk',
      discountAmount: discount,
      discountPercent: percent,
      validFrom: new Date().toISOString().split('T')[0],
      validTo: new Date(Date.now() + 7 * 86400000).toISOString().split('T')[0],
      validUntilText: validUntilText || 'Gælder denne uge',
      daysRemaining: parseInt(daysRemaining) || 5,
      limitText: limitText ? limitText : undefined,
      tilbudsavisUrl: tilbudsavisUrl || 'https://etilbudsavis.dk',
      imageUrl: imageUrl || 'https://images.unsplash.com/photo-1548907040-4baa42d10919?w=600&auto=format&fit=crop&q=80',
      badge: badge || 'Nyt tilbud',
    };

    onAddDeal(newDeal);
    onClose();
  };

  return (
    <div className="fixed inset-0 z-50 overflow-y-auto flex items-center justify-center p-4 sm:p-6">
      <div
        className="fixed inset-0 bg-slate-950/70 backdrop-blur-xs transition-opacity"
        onClick={onClose}
      />

      <div className="relative bg-white rounded-3xl max-w-lg w-full shadow-2xl border border-slate-200 overflow-hidden z-10">
        
        {/* Header */}
        <div className="p-5 border-b border-slate-100 flex items-center justify-between bg-slate-50">
          <div>
            <h2 className="text-lg font-bold text-slate-900">
              Tilføj nyt tilbud
            </h2>
            <p className="text-xs text-slate-500">
              Udfyld data om tilbuddet for at tilføje det til oversigten
            </p>
          </div>
          <button
            onClick={onClose}
            className="p-2 text-slate-400 hover:text-slate-600 rounded-lg hover:bg-slate-200"
          >
            <X className="w-5 h-5" />
          </button>
        </div>

        {/* Form Body */}
        <form onSubmit={handleSubmit} className="p-5 space-y-4 max-h-[75vh] overflow-y-auto">
          
          <div className="grid grid-cols-2 gap-3">
            <div>
              <label className="block text-xs font-semibold text-slate-700 mb-1">Varenavn *</label>
              <input
                type="text"
                required
                value={name}
                onChange={(e) => setName(e.target.value)}
                placeholder="f.eks. Ritter Sport Chokolade"
                className="w-full px-3 py-2 text-xs border border-slate-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-600"
              />
            </div>
            <div>
              <label className="block text-xs font-semibold text-slate-700 mb-1">Mærke *</label>
              <input
                type="text"
                required
                value={brand}
                onChange={(e) => setBrand(e.target.value)}
                placeholder="f.eks. Ritter Sport"
                className="w-full px-3 py-2 text-xs border border-slate-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-600"
              />
            </div>
          </div>

          <div className="grid grid-cols-2 gap-3">
            <div>
              <label className="block text-xs font-semibold text-slate-700 mb-1">Variant / Vægt</label>
              <input
                type="text"
                value={variant}
                onChange={(e) => setVariant(e.target.value)}
                placeholder="100 g / 1,5 liter"
                className="w-full px-3 py-2 text-xs border border-slate-300 rounded-xl"
              />
            </div>
            <div>
              <label className="block text-xs font-semibold text-slate-700 mb-1">Kategori</label>
              <select
                value={category}
                onChange={(e) => setCategory(e.target.value as Category)}
                className="w-full px-3 py-2 text-xs border border-slate-300 rounded-xl bg-white"
              >
                <option value="slik_chokolade">Slik & Chokolade</option>
                <option value="drikkevarer">Sodavand & Cola</option>
                <option value="juice">Æble Juice</option>
                <option value="frost">Frost & Grønt</option>
                <option value="mejeri">Kakaomælk & Mejeri</option>
                <option value="fitness_energi">Protein & Energi Bar</option>
              </select>
            </div>
          </div>

          <div className="grid grid-cols-2 gap-3">
            <div>
              <label className="block text-xs font-semibold text-slate-700 mb-1">Butik</label>
              <select
                value={store}
                onChange={(e) => setStore(e.target.value as StoreName)}
                className="w-full px-3 py-2 text-xs border border-slate-300 rounded-xl bg-white"
              >
                <option value="Netto">Netto</option>
                <option value="Rema 1000">Rema 1000</option>
                <option value="Bilka">Bilka</option>
                <option value="Lidl">Lidl</option>
                <option value="Coop 365">Coop 365</option>
                <option value="Meny">Meny</option>
                <option value="SuperBrugsen">SuperBrugsen</option>
              </select>
            </div>
            <div>
              <label className="block text-xs font-semibold text-slate-700 mb-1">Mærkat / Badge</label>
              <input
                type="text"
                value={badge}
                onChange={(e) => setBadge(e.target.value)}
                placeholder="f.eks. Ugens Superkup"
                className="w-full px-3 py-2 text-xs border border-slate-300 rounded-xl"
              />
            </div>
          </div>

          <div className="grid grid-cols-3 gap-2 bg-emerald-50/70 p-3 rounded-2xl border border-emerald-100">
            <div>
              <label className="block text-[11px] font-bold text-emerald-950 mb-1">Tilbudspris (kr) *</label>
              <input
                type="number"
                step="0.05"
                required
                value={currentPrice}
                onChange={(e) => setCurrentPrice(e.target.value)}
                className="w-full px-2.5 py-1.5 text-xs font-bold bg-white border border-emerald-300 rounded-lg"
              />
            </div>
            <div>
              <label className="block text-[11px] font-bold text-slate-700 mb-1">Førpris (kr) *</label>
              <input
                type="number"
                step="0.05"
                required
                value={originalPrice}
                onChange={(e) => setOriginalPrice(e.target.value)}
                className="w-full px-2.5 py-1.5 text-xs bg-white border border-slate-300 rounded-lg"
              />
            </div>
            <div>
              <label className="block text-[11px] font-bold text-slate-700 mb-1">Enhedspris</label>
              <input
                type="text"
                value={unitPrice}
                onChange={(e) => setUnitPrice(e.target.value)}
                placeholder="120,00 kr./kg"
                className="w-full px-2.5 py-1.5 text-xs bg-white border border-slate-300 rounded-lg"
              />
            </div>
          </div>

          <div className="grid grid-cols-2 gap-3">
            <div>
              <label className="block text-xs font-semibold text-slate-700 mb-1">Gyldighedstekst</label>
              <input
                type="text"
                value={validUntilText}
                onChange={(e) => setValidUntilText(e.target.value)}
                placeholder="Gælder t.o.m. fredag 21. aug"
                className="w-full px-3 py-2 text-xs border border-slate-300 rounded-xl"
              />
            </div>
            <div>
              <label className="block text-xs font-semibold text-slate-700 mb-1">Dage tilbage</label>
              <input
                type="number"
                value={daysRemaining}
                onChange={(e) => setDaysRemaining(e.target.value)}
                className="w-full px-3 py-2 text-xs border border-slate-300 rounded-xl"
              />
            </div>
          </div>

          <div>
            <label className="block text-xs font-semibold text-slate-700 mb-1">Begrænsning (valgfri)</label>
            <input
              type="text"
              value={limitText}
              onChange={(e) => setLimitText(e.target.value)}
              placeholder="f.eks. Maks. 6 stk. pr. kunde derefter normalpris"
              className="w-full px-3 py-2 text-xs border border-slate-300 rounded-xl"
            />
          </div>

          <div>
            <label className="block text-xs font-semibold text-slate-700 mb-1">Link til tilbudsavis</label>
            <input
              type="url"
              value={tilbudsavisUrl}
              onChange={(e) => setTilbudsavisUrl(e.target.value)}
              className="w-full px-3 py-2 text-xs border border-slate-300 rounded-xl font-mono"
            />
          </div>

          <div>
            <label className="block text-xs font-semibold text-slate-700 mb-1">Billed-URL</label>
            <input
              type="url"
              value={imageUrl}
              onChange={(e) => setImageUrl(e.target.value)}
              className="w-full px-3 py-2 text-xs border border-slate-300 rounded-xl font-mono"
            />
          </div>

          {/* Submit */}
          <div className="pt-2 flex items-center justify-end gap-2">
            <button
              type="button"
              onClick={onClose}
              className="px-4 py-2 text-xs font-semibold text-slate-600 hover:bg-slate-100 rounded-xl"
            >
              Annuller
            </button>
            <button
              type="submit"
              className="px-5 py-2 text-xs font-bold text-white bg-emerald-600 hover:bg-emerald-700 rounded-xl shadow-xs"
            >
              Gem tilbud
            </button>
          </div>

        </form>

      </div>
    </div>
  );
};
