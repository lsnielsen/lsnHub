import React from 'react';
import { ShoppingBag, Code, Plus, Tag } from 'lucide-react';
import { ShoppingItem } from '../types';
import { getCurrentWeekNumber } from '../utils/dateUtils';

interface NavbarProps {
  shoppingList: ShoppingItem[];
  onOpenShoppingList: () => void;
  onOpenPhpCode: () => void;
  onOpenAddDeal: () => void;
}

export const Navbar: React.FC<NavbarProps> = ({
  shoppingList,
  onOpenShoppingList,
  onOpenPhpCode,
  onOpenAddDeal,
}) => {
  const currentWeek = getCurrentWeekNumber();
  const totalItemsCount = shoppingList.reduce((acc, item) => acc + item.quantity, 0);
  const totalSaved = shoppingList.reduce(
    (acc, item) => acc + item.deal.discountAmount * item.quantity,
    0
  );

  return (
    <header className="sticky top-0 z-40 bg-white/90 backdrop-blur-md border-b border-slate-200">
      <div className="max-w-6xl mx-auto px-4 sm:px-6">
        <div className="flex items-center justify-between h-16">
          
          {/* Logo & Dynamic Week */}
          <div className="flex items-center gap-3">
            <div className="w-9 h-9 rounded-xl bg-emerald-600 flex items-center justify-center text-white font-bold shadow-xs">
              %
            </div>
            <div className="flex items-center gap-2">
              <h1 className="text-lg font-bold text-slate-900 tracking-tight">
                Tilbudsoversigt
              </h1>
              <span className="inline-flex items-center px-2 py-0.5 text-xs font-semibold rounded-md bg-emerald-50 text-emerald-700 border border-emerald-200/80">
                Uge {currentWeek}
              </span>
            </div>
          </div>

          {/* Clean Action Buttons */}
          <div className="flex items-center gap-2">
            
            {/* PHP Source / Htdocs Button */}
            <button
              id="php-code-button"
              onClick={onOpenPhpCode}
              className="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-medium text-slate-600 bg-slate-100 hover:bg-slate-200 rounded-lg transition-colors"
              title="Se og hent PHP kildekode til localhost/htdocs"
            >
              <Code className="w-3.5 h-3.5 text-slate-500" />
              <span className="hidden sm:inline">PHP / htdocs</span>
            </button>

            {/* Add Deal Button */}
            <button
              id="add-deal-button"
              onClick={onOpenAddDeal}
              className="inline-flex items-center gap-1 px-3 py-1.5 text-xs font-medium text-slate-700 bg-slate-100 hover:bg-slate-200 rounded-lg transition-colors"
            >
              <Plus className="w-3.5 h-3.5 text-slate-600" />
              <span className="hidden sm:inline">Tilføj tilbud</span>
            </button>

            {/* Shopping List Trigger */}
            <button
              id="shopping-list-button"
              onClick={onOpenShoppingList}
              className="relative inline-flex items-center gap-1.5 px-3.5 py-1.5 text-xs font-semibold text-white bg-emerald-600 hover:bg-emerald-700 rounded-lg transition-colors shadow-xs"
            >
              <ShoppingBag className="w-3.5 h-3.5" />
              <span>Indkøbsliste</span>
              {totalItemsCount > 0 && (
                <span className="inline-flex items-center justify-center px-1.5 py-0.2 bg-white text-emerald-800 text-[11px] font-bold rounded-full ml-0.5">
                  {totalItemsCount}
                </span>
              )}
            </button>
          </div>

        </div>
      </div>
    </header>
  );
};
