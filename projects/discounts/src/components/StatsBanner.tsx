import React from 'react';
import { Deal } from '../types';
import { Percent, Store, Calendar, TrendingUp } from 'lucide-react';

interface StatsBannerProps {
  deals: Deal[];
}

export const StatsBanner: React.FC<StatsBannerProps> = ({ deals }) => {
  const totalDeals = deals.length;
  const maxSavings = Math.max(...deals.map((d) => d.discountPercent), 0);
  const avgSavings = Math.round(
    deals.reduce((acc, d) => acc + d.discountPercent, 0) / (deals.length || 1)
  );
  const uniqueStores = new Set(deals.map((d) => d.store)).size;

  return (
    <div className="bg-gradient-to-r from-emerald-900 via-slate-900 to-emerald-950 text-white rounded-2xl p-5 sm:p-6 shadow-sm border border-emerald-800/40 mb-6">
      <div className="flex flex-col lg:flex-row lg:items-center justify-between gap-6">
        <div>
          <div className="flex items-center gap-2 text-emerald-400 text-xs font-semibold uppercase tracking-wider mb-1">
            <TrendingUp className="w-4 h-4" />
            <span>Ugens Tilbudsovervågning</span>
          </div>
          <h2 className="text-xl sm:text-2xl font-bold tracking-tight text-white">
            Find ugens skarpeste tilbud på dine favoritvarer
          </h2>
          <p className="text-slate-300 text-sm mt-1 max-w-2xl">
            Her er overblikket over Ritter Sport, Coca-Cola, chokolade, Mathilde kakaomælk, frosne grøntsager, protein drikke, Murphy energibarer og æblejuice med direkte avis-links.
          </p>
        </div>

        {/* Metric Badges */}
        <div className="grid grid-cols-2 sm:grid-cols-4 gap-3">
          <div className="bg-white/10 backdrop-blur-xs rounded-xl p-3 border border-white/10 text-center">
            <div className="text-2xl font-extrabold text-emerald-400">
              {maxSavings}%
            </div>
            <div className="text-xs text-slate-300 font-medium mt-0.5">
              Maks rabat
            </div>
          </div>

          <div className="bg-white/10 backdrop-blur-xs rounded-xl p-3 border border-white/10 text-center">
            <div className="text-2xl font-extrabold text-amber-300">
              {avgSavings}%
            </div>
            <div className="text-xs text-slate-300 font-medium mt-0.5">
              Gns. besparelse
            </div>
          </div>

          <div className="bg-white/10 backdrop-blur-xs rounded-xl p-3 border border-white/10 text-center">
            <div className="text-2xl font-extrabold text-white">
              {totalDeals}
            </div>
            <div className="text-xs text-slate-300 font-medium mt-0.5">
              Aktive tilbud
            </div>
          </div>

          <div className="bg-white/10 backdrop-blur-xs rounded-xl p-3 border border-white/10 text-center">
            <div className="text-2xl font-extrabold text-sky-400">
              {uniqueStores}
            </div>
            <div className="text-xs text-slate-300 font-medium mt-0.5">
              Butikker
            </div>
          </div>
        </div>
      </div>
    </div>
  );
};
