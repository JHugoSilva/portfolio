import { inject } from "vue";
import { portfolioKey } from "./keys";

export function usePortfolioInject() {
    const portfolio = inject(portfolioKey);
    if (!portfolio) {
        throw new Error("Portfolio não foi provido");
    }
    return portfolio;
}
