export function toggleMenu(tab) {
    const index = this.selectedFilters.indexOf(tab);
    if (index === -1) {
        this.selectedFilters.push(tab);
    } else {
        this.selectedFilters.splice(index, 1);
    }
}

export function activeMenu(tab) {
    return this.selectedFilters.includes(tab);
}
