export type StoreName =
  | 'Netto'
  | 'Rema 1000'
  | 'Bilka'
  | 'Lidl'
  | 'Coop 365'
  | 'Meny'
  | 'SuperBrugsen';

export type Category =
  | 'alle'
  | 'slik_chokolade'
  | 'drikkevarer'
  | 'juice'
  | 'frost'
  | 'mejeri'
  | 'fitness_energi';

export interface Deal {
  id: string;
  name: string;
  brand: string;
  variant: string;
  category: Category;
  store: StoreName;
  storeColor: string;
  storeBg: string;
  currentPrice: number;
  originalPrice: number;
  unitPrice: string;
  discountAmount: number;
  discountPercent: number;
  validFrom: string;
  validTo: string;
  validUntilText: string;
  daysRemaining: number;
  limitText?: string;
  tilbudsavisUrl: string;
  imageUrl: string;
  featured?: boolean;
  badge?: string;
  description?: string;
}

export interface ShoppingItem {
  deal: Deal;
  quantity: number;
}
