import React, { useState, useEffect, useMemo } from 'react';
import { Navbar } from './components/Navbar';
import { Filters } from './components/Filters';
import { DealCard } from './components/DealCard';
import { ShoppingListDrawer } from './components/ShoppingListDrawer';
import { DealDetailModal } from './components/DealDetailModal';
import { PhpSourceModal } from './components/PhpSourceModal';
import { AddDealModal } from './components/AddDealModal';
import { INITIAL_DEALS } from './data/dealsData';
import { Deal, Category, ShoppingItem } from './types';
import { RefreshCw, Code, Tag } from 'lucide-react';
import { getCurrentWeekNumber } from './utils/dateUtils';

export default function App() {
  // Deals State
  const [deals, setDeals] = useState<Deal[]>(() => {
    const saved = localStorage.getItem('tilbud_deals');
    if (saved) {
      try {
        const parsed: Deal[] = JSON.parse(saved);
        // Exclude any deals from Føtex
        const cleaned = parsed.filter((d) => (d.store as string) !== 'Føtex');
        return cleaned.length > 0 ? cleaned : INITIAL_DEALS;
      } catch (e) {
        return INITIAL_DEALS;
      }
    }
    return INITIAL_DEALS;
  });

  // Shopping List State
  const [shoppingList, setShoppingList] = useState<ShoppingItem[]>(() => {
    const saved = localStorage.getItem('tilbud_shopping_list');
    if (saved) {
      try {
        return JSON.parse(saved);
      } catch (e) {
        return [];
      }
    }
    return [];
  });

  // Filters State
  const [searchQuery, setSearchQuery] = useState('');
  const [selectedCategory, setSelectedCategory] = useState<Category>('alle');
  const [selectedStore, setSelectedStore] = useState('Alle butikker');
  const [sortBy, setSortBy] = useState<'discount-desc' | 'price-asc' | 'savings-kr-desc' | 'days-asc'>('discount-desc');
  const [onlyHighDiscount, setOnlyHighDiscount] = useState(false);

  // Modals
  const [isShoppingListOpen, setIsShoppingListOpen] = useState(false);
  const [isPhpModalOpen, setIsPhpModalOpen] = useState(false);
  const [isAddDealOpen, setIsAddDealOpen] = useState(false);
  const [selectedDealForDetail, setSelectedDealForDetail] = useState<Deal | null>(null);

  const currentWeek = getCurrentWeekNumber();

  // Sync to LocalStorage
  useEffect(() => {
    localStorage.setItem('tilbud_deals', JSON.stringify(deals));
  }, [deals]);

  useEffect(() => {
    localStorage.setItem('tilbud_shopping_list', JSON.stringify(shoppingList));
  }, [shoppingList]);

  // Shopping list toggle
  const handleToggleShoppingList = (deal: Deal) => {
    setShoppingList((prev) => {
      const exists = prev.find((item) => item.deal.id === deal.id);
      if (exists) {
        return prev.filter((item) => item.deal.id !== deal.id);
      } else {
        return [...prev, { deal, quantity: 1 }];
      }
    });
  };

  const handleUpdateQuantity = (dealId: string, quantity: number) => {
    if (quantity <= 0) {
      handleRemoveShoppingItem(dealId);
      return;
    }
    setShoppingList((prev) =>
      prev.map((item) =>
        item.deal.id === dealId ? { ...item, quantity } : item
      )
    );
  };

  const handleRemoveShoppingItem = (dealId: string) => {
    setShoppingList((prev) => prev.filter((item) => item.deal.id !== dealId));
  };

  const handleClearShoppingList = () => {
    setShoppingList([]);
  };

  const handleAddDeal = (newDeal: Deal) => {
    setDeals((prev) => [newDeal, ...prev]);
  };

  const handleResetToDefaultDeals = () => {
    setDeals(INITIAL_DEALS);
    localStorage.removeItem('tilbud_deals');
  };

  // Filtered & Sorted Deals
  const filteredDeals = useMemo(() => {
    return deals
      .filter((deal) => {
        // Search
        if (searchQuery) {
          const q = searchQuery.toLowerCase().trim();
          const matchName = deal.name.toLowerCase().includes(q);
          const matchBrand = deal.brand.toLowerCase().includes(q);
          const matchStore = deal.store.toLowerCase().includes(q);
          const matchVariant = deal.variant.toLowerCase().includes(q);
          if (!matchName && !matchBrand && !matchStore && !matchVariant) {
            return false;
          }
        }

        // Category
        if (selectedCategory !== 'alle' && deal.category !== selectedCategory) {
          return false;
        }

        // Store
        if (selectedStore !== 'Alle butikker' && deal.store !== selectedStore) {
          return false;
        }

        // High discount toggle (> 45%)
        if (onlyHighDiscount && deal.discountPercent < 45) {
          return false;
        }

        return true;
      })
      .sort((a, b) => {
        switch (sortBy) {
          case 'discount-desc':
            return b.discountPercent - a.discountPercent;
          case 'savings-kr-desc':
            return b.discountAmount - a.discountAmount;
          case 'price-asc':
            return a.currentPrice - b.currentPrice;
          case 'days-asc':
            return a.daysRemaining - b.daysRemaining;
          default:
            return 0;
        }
      });
  }, [deals, searchQuery, selectedCategory, selectedStore, onlyHighDiscount, sortBy]);

  const shoppingListIds = useMemo(() => {
    return new Set(shoppingList.map((i) => i.deal.id));
  }, [shoppingList]);

  return (
    <div className="min-h-screen bg-slate-50 text-slate-900 flex flex-col font-sans selection:bg-emerald-100 selection:text-emerald-900">
      
      {/* Top Navbar */}
      <Navbar
        shoppingList={shoppingList}
        onOpenShoppingList={() => setIsShoppingListOpen(true)}
        onOpenPhpCode={() => setIsPhpModalOpen(true)}
        onOpenAddDeal={() => setIsAddDealOpen(true)}
      />

      {/* Main Container */}
      <main className="max-w-6xl mx-auto px-4 sm:px-6 py-6 flex-1 w-full">
        
        {/* Simple Page Header */}
        <div className="mb-5">
          <h2 className="text-xl sm:text-2xl font-extrabold tracking-tight text-slate-900">
            Aktuelle tilbud (Uge {currentWeek})
          </h2>
          <p className="text-xs sm:text-sm text-slate-500 mt-0.5">
            Oversigt over ugens bedste priser i Netto, Rema 1000, Bilka, Lidl, Coop 365 og Meny
          </p>
        </div>

        {/* Clean Filter and Search */}
        <Filters
          searchQuery={searchQuery}
          setSearchQuery={setSearchQuery}
          selectedCategory={selectedCategory}
          setSelectedCategory={setSelectedCategory}
          selectedStore={selectedStore}
          setSelectedStore={setSelectedStore}
          sortBy={sortBy}
          setSortBy={setSortBy}
          onlyHighDiscount={onlyHighDiscount}
          setOnlyHighDiscount={setOnlyHighDiscount}
          resultsCount={filteredDeals.length}
        />

        {/* Deals Cards Grid */}
        {filteredDeals.length === 0 ? (
          <div className="bg-white rounded-2xl p-10 text-center border border-slate-200 shadow-xs max-w-md mx-auto my-8">
            <Tag className="w-8 h-8 text-slate-300 mx-auto mb-3" />
            <h3 className="text-base font-bold text-slate-900">
              Ingen tilbud fundet
            </h3>
            <p className="text-xs text-slate-500 mt-1">
              Prøv at søge efter noget andet eller nulstille dine filtre.
            </p>
            <button
              onClick={() => {
                setSearchQuery('');
                setSelectedCategory('alle');
                setSelectedStore('Alle butikker');
                setOnlyHighDiscount(false);
              }}
              className="mt-4 px-4 py-2 bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-semibold rounded-lg transition-colors"
            >
              Vis alle tilbud
            </button>
          </div>
        ) : (
          <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-5">
            {filteredDeals.map((deal) => (
              <DealCard
                key={deal.id}
                deal={deal}
                isInShoppingList={shoppingListIds.has(deal.id)}
                onToggleShoppingList={handleToggleShoppingList}
                onSelectDeal={(d) => setSelectedDealForDetail(d)}
              />
            ))}
          </div>
        )}

      </main>

      {/* Simple Footer */}
      <footer className="bg-white border-t border-slate-200 mt-10 py-6 text-xs text-slate-500">
        <div className="max-w-6xl mx-auto px-4 sm:px-6 flex flex-col sm:flex-row items-center justify-between gap-3">
          <div className="flex items-center gap-2">
            <span className="font-semibold text-slate-800">Tilbudsoversigt</span>
            <span>•</span>
            <span>Uge {currentWeek}</span>
          </div>

          <div className="flex items-center gap-4">
            <button
              onClick={handleResetToDefaultDeals}
              className="inline-flex items-center gap-1 text-slate-500 hover:text-slate-800 transition-colors"
            >
              <RefreshCw className="w-3 h-3" />
              <span>Gendan data</span>
            </button>
            <span>•</span>
            <button
              onClick={() => setIsPhpModalOpen(true)}
              className="inline-flex items-center gap-1 text-emerald-700 font-semibold hover:text-emerald-900 transition-colors"
            >
              <Code className="w-3 h-3" />
              <span>PHP / htdocs kode</span>
            </button>
          </div>
        </div>
      </footer>

      {/* Modals & Drawers */}
      <ShoppingListDrawer
        isOpen={isShoppingListOpen}
        onClose={() => setIsShoppingListOpen(false)}
        shoppingList={shoppingList}
        onUpdateQuantity={handleUpdateQuantity}
        onRemoveItem={handleRemoveShoppingItem}
        onClearList={handleClearShoppingList}
      />

      <DealDetailModal
        deal={selectedDealForDetail}
        onClose={() => setSelectedDealForDetail(null)}
        onToggleShoppingList={handleToggleShoppingList}
        isInShoppingList={
          selectedDealForDetail ? shoppingListIds.has(selectedDealForDetail.id) : false
        }
      />

      <PhpSourceModal
        isOpen={isPhpModalOpen}
        onClose={() => setIsPhpModalOpen(false)}
      />

      <AddDealModal
        isOpen={isAddDealOpen}
        onClose={() => setIsAddDealOpen(false)}
        onAddDeal={handleAddDeal}
      />

    </div>
  );
}
