/**
 * Beregner det aktuelle ugenummer efter dansk standard (ISO-8601)
 */
export function getCurrentWeekNumber(d: Date = new Date()): number {
  const target = new Date(Date.UTC(d.getFullYear(), d.getMonth(), d.getDate()));
  const dayNr = target.getUTCDay() || 7;
  target.setUTCDate(target.getUTCDate() + 4 - dayNr);
  const yearStart = new Date(Date.UTC(target.getUTCFullYear(), 0, 1));
  const weekNo = Math.ceil(((target.getTime() - yearStart.getTime()) / 86400000 + 1) / 7);
  return weekNo;
}

export function formatPriceDKK(amount: number): string {
  return amount.toFixed(2).replace('.', ',') + ' kr.';
}
