export function updateSliderRange() {
    const rangeMin = 0
    const range = this.$refs.range

    let minRangeDot = this.$refs.rangeMin
    let maxRangeDot = this.$refs.rangeMax

    let minRangeValue = this.$refs.priceMin
    let maxRangeValue = this.$refs.priceMax

    let minDot = minRangeDot.value
    let maxDot = maxRangeDot.value

    if(event.target === minRangeDot) {
        minRangeDot.style.zIndex = '1';
        maxRangeDot.style.zIndex = '0';
    } else {
        minRangeDot.style.zIndex = '0';
        maxRangeDot.style.zIndex = '1';
    }

    if (maxDot - minDot < rangeMin) {
        if (event.target === minRangeDot) {
            minRangeDot.value = maxDot - rangeMin;
        } else {
            maxRangeDot.value = minDot + rangeMin;
        }
    } else {
        minRangeValue.value = minDot;
        maxRangeValue.value = maxDot;

        range.style.left = ((minDot - this.prices[0]) / (minRangeDot.max - this.prices[0])) * 100 + "%";
        range.style.right = 100 - ((maxDot - this.prices[0]) / (maxRangeDot.max - this.prices[0])) * 100 + "%";
    }
}

export function updateSliderPrice() {
    const rangeMin = 0
    const range = this.$refs.range

    let minRangeDot = this.$refs.rangeMin
    let maxRangeDot = this.$refs.rangeMax

    let minRangeValue = this.$refs.priceMin
    let maxRangeValue = this.$refs.priceMax

    let minValue = minRangeValue.value
    let maxValue = maxRangeValue.value

    if (maxValue - minValue >= rangeMin) {
        if (event.target === minRangeValue) {
            minRangeDot.value = minValue;
            range.style.left = ((minRangeDot.value - this.prices[0]) / (minRangeDot.max - this.prices[0])) * 100 + "%";
        } else {
            maxRangeDot.value = maxValue;
            range.style.right = 100 - ((maxRangeDot.value - this.prices[0]) / (maxRangeDot.max - this.prices[0])) * 100 + "%";
        }
    }
}
