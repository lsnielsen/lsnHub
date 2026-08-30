import React from 'react';
import { Search, X, ArrowUpDown } from 'lucide-react';
import { Category } from '../types';
import { CATEGORIES, STORES } from '../data/dealsData';

interface FiltersProps {
  searchQuery: string;
  setSearchQuery: (q: string) => void;
  selectedCategory: Category;
  setSelectedCategory: (cat: Category) => void;
  selectedStore: string;
  setSelectedStore: (store: string) => void;
  sortBy: 'discount-desc' | 'price-asc' | 'savings-kr-desc' | 'days-asc';
  setSortBy: (sort: 'discount-desc' | 'price-asc' | 'savings-kr-desc' | 'days-asc') => void;
  onlyHighDiscount: boolean;
  setOnlyHighDiscount: (val: boolean) => void;
  resultsCount: number;
}

export const Filters: React.FC<FiltersProps> = ({
  searchQuery,
  setSearchQuery,
  selectedCategory,
  setSelectedCategory,
  selectedStore,
  setSelectedStore,
  sortBy,
  setSortBy,
  onlyHighDiscount,
  setOnlyHighDiscount,
  resultsCount,
}) => {
  const hasActiveFilters =
    searchQuery !== '' ||
    selectedCategory !== 'alle' ||
    selectedStore !== 'Alle butikker' ||
    onlyHighDiscount;

  const resetFilters = () => {
    setSearchQuery('');
    setSelectedCategory('alle');
    setSelectedStore('Alle butikker');
    setOnlyHighDiscount(false);
  };

  return (
    <div className="space-y-3 mb-6">
      
      {/* Top Search & Controls Bar */}
      <div className="flex flex-col sm:flex-row items-stretch sm:items-center gap-2.5">
        
        {/* Search */}
        <div className="relative flex-1">
          <Search className="w-4 h-4 text-slate-400 absolute left-3.5 top-1/2 -translate-y-1/2" />
          <input
            id="deal-search-input"
            type="text"
            placeholder="Søg efter vare, mærke eller butik..."
            value={searchQuery}
            onChange={(e) => setSearchQuery(e.target.value)}
            className="w-full pl-10 pr-9 py-2.5 bg-white border border-slate-200 rounded-xl text-sm font-medium text-slate-900 placeholder:text-slate-400 focus:outline-none focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 shadow-xs"
          />
          {searchQuery && (
            <button
              onClick={() => setSearchQuery('')}
              className="absolute right-3 top-1/2 -translate-y-1/2 text-slate-400 hover:text-slate-600 p-1"
            >
              <X className="w-3.5 h-3.5" />
            </button>
          )}
        </div>

        {/* Store Selector */}
        <div className="flex items-center gap-2">
          <select
            id="deal-store-select"
            value={selectedStore}
            onChange={(e) => setSelectedStore(e.target.value)}
            className="px-3 py-2.5 bg-white border border-slate-200 rounded-xl text-xs font-semibold text-slate-700 focus:outline-none focus:border-emerald-500 shadow-xs cursor-pointer"
          >
            <option value="Alle butikker">Alle butikker</option>
            {STORES.map((s) => (
              <option key={s.name} value={s.name}>
                {s.name}
              </option>
            ))}
          </select>

          {/* Sort Selector */}
          <div className="relative">
            <select
              id="deal-sort-select"
              value={sortBy}
              onChange={(e) => setSortBy(e.target.value as any)}
              className="appearance-none pl-7 pr-7 py-2.5 bg-white border border-slate-200 rounded-xl text-xs font-semibold text-slate-700 focus:outline-none focus:border-emerald-500 shadow-xs cursor-pointer"
            >
              <option value="discount-desc">Største rabat (%)</option>
              <option value="savings-kr-desc">Største besparelse (kr.)</option>
              <option value="price-asc">Laveste pris</option>
              <option value="days-asc">Udløber snarest</option>
            </select>
            <ArrowUpDown className="w-3.5 h-3.5 text-slate-400 absolute left-2.5 top-1/2 -translate-y-1/2 pointer-events-none" />
          </div>
        </div>

      </div>

      {/* Category Pills Bar */}
      <div className="flex items-center justify-between gap-2 overflow-x-auto pb-1 no-scrollbar">
        <div className="flex items-center gap-1.5 shrink-0">
          {CATEGORIES.map((cat) => {
            const isActive = selectedCategory === cat.id;
            return (
              <button
                key={cat.id}
                id={`cat-filter-${cat.id}`}
                onClick={() => setSelectedCategory(cat.id as Category)}
                className={`px-3 py-1.5 rounded-lg text-xs font-medium whitespace-nowrap transition-colors ${
                  isActive
                    ? 'bg-slate-900 text-white'
                    : 'bg-white border border-slate-200 text-slate-600 hover:bg-slate-50'
                }`}
              >
                {cat.label}
              </button>
            );
          })}
        </div>

        {/* Active count & Reset */}
        <div className="flex items-center gap-2 text-xs text-slate-500 whitespace-nowrap pl-2">
          <span>{resultsCount} tilbud</span>
          {hasActiveFilters && (
            <button
              id="reset-filters-button"
              onClick={resetFilters}
              className="text-emerald-700 hover:text-emerald-900 font-semibold underline"
            >
              Nulstil
            </button>
          )}
        </div>
      </div>

    </div>
  );
};
