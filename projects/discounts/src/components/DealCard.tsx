import React from 'react';
import { Deal } from '../types';
import { ExternalLink, Plus, Check } from 'lucide-react';

interface DealCardProps {
  deal: Deal;
  isInShoppingList: boolean;
  onToggleShoppingList: (deal: Deal) => void;
  onSelectDeal: (deal: Deal) => void;
}

export const DealCard: React.FC<DealCardProps> = ({
  deal,
  isInShoppingList,
  onToggleShoppingList,
  onSelectDeal,
}) => {
  const formattedPrice = deal.currentPrice.toFixed(2).replace('.', ',');
  const formattedOriginalPrice = deal.originalPrice.toFixed(2).replace('.', ',');
  const formattedDiscountAmount = deal.discountAmount.toFixed(2).replace('.', ',');

  return (
    <div
      id={`deal-card-${deal.id}`}
      className="group bg-white rounded-2xl border border-slate-200/90 shadow-xs hover:shadow-md transition-all flex flex-col overflow-hidden"
    >
      {/* Product Image & Badges */}
      <div 
        className="relative h-44 bg-slate-100 overflow-hidden cursor-pointer"
        onClick={() => onSelectDeal(deal)}
      >
        <img
          src={deal.imageUrl}
          alt={deal.name}
          className="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300"
          loading="lazy"
          referrerPolicy="no-referrer"
        />

        {/* Store & Discount Badges */}
        <div className="absolute top-2.5 left-2.5 flex items-center gap-1.5">
          <span
            className="px-2 py-0.5 text-xs font-bold text-white rounded-md shadow-xs"
            style={{ backgroundColor: deal.storeColor }}
          >
            {deal.store}
          </span>
        </div>

        <div className="absolute top-2.5 right-2.5">
          <span className="px-2 py-0.5 text-xs font-bold bg-rose-600 text-white rounded-md shadow-xs">
            -{deal.discountPercent}%
          </span>
        </div>
      </div>

      {/* Content */}
      <div className="p-4 flex flex-col flex-1">
        
        {/* Brand & Unit price */}
        <div className="flex items-center justify-between text-xs text-slate-500 mb-1">
          <span className="font-semibold text-slate-700">{deal.brand}</span>
          <span>{deal.unitPrice}</span>
        </div>

        {/* Title */}
        <h3
          onClick={() => onSelectDeal(deal)}
          className="text-base font-bold text-slate-900 group-hover:text-emerald-700 transition-colors cursor-pointer line-clamp-1"
        >
          {deal.name}
        </h3>

        {/* Variant */}
        <p className="text-xs text-slate-500 line-clamp-1 mb-3">
          {deal.variant}
        </p>

        {/* Price & Savings */}
        <div className="mt-auto bg-slate-50 border border-slate-100 rounded-xl p-2.5 mb-3">
          <div className="flex items-baseline justify-between">
            <div className="text-xl font-extrabold text-slate-900">
              {formattedPrice} <span className="text-xs font-medium text-slate-600">kr.</span>
            </div>
            <div className="text-right">
              <span className="text-xs font-bold text-rose-700">
                Spar {formattedDiscountAmount} kr.
              </span>
              <span className="text-[11px] text-slate-400 block line-through">
                Før {formattedOriginalPrice} kr.
              </span>
            </div>
          </div>
        </div>

        {/* Validity */}
        <div className="text-[11px] text-slate-500 mb-3 flex items-center justify-between">
          <span>{deal.validUntilText}</span>
          <span className="text-emerald-700 font-medium">{deal.daysRemaining} dage tilbage</span>
        </div>

        {/* Actions */}
        <div className="grid grid-cols-2 gap-2 mt-auto">
          <a
            id={`avis-link-${deal.id}`}
            href={deal.tilbudsavisUrl}
            target="_blank"
            rel="noopener noreferrer"
            className="inline-flex items-center justify-center gap-1 px-3 py-2 text-xs font-medium text-slate-700 bg-slate-100 hover:bg-slate-200 rounded-xl transition-colors"
          >
            <span>Tilbudsavis</span>
            <ExternalLink className="w-3 h-3 text-slate-400" />
          </a>

          <button
            id={`add-to-cart-${deal.id}`}
            type="button"
            onClick={() => onToggleShoppingList(deal)}
            className={`inline-flex items-center justify-center gap-1 px-3 py-2 text-xs font-semibold rounded-xl transition-colors ${
              isInShoppingList
                ? 'bg-emerald-600 text-white hover:bg-emerald-700'
                : 'bg-emerald-50 text-emerald-800 hover:bg-emerald-100 border border-emerald-200'
            }`}
          >
            {isInShoppingList ? (
              <>
                <Check className="w-3.5 h-3.5" />
                <span>I kurv</span>
              </>
            ) : (
              <>
                <Plus className="w-3.5 h-3.5" />
                <span>Tilføj</span>
              </>
            )}
          </button>
        </div>

      </div>
    </div>
  );
};
