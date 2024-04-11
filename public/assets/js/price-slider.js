export function updateSliderRange() {
    const rangeMin = 0
    const range = this.$refs.range

    let minRangeDot = this.$refs.rangeMin
    let maxRangeDot = this.$refs.rangeMax

    let minRangeValue = this.$refs.priceMin
    let maxRangeValue = this.$refs.priceMax

    let minDot = parseInt(minRangeDot.value)
    let maxDot = parseInt(maxRangeDot.value)

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

        range.style.left = ((minDot - this.pricesList.min) / (minRangeDot.max - this.pricesList.min)) * 100 + "%";
        range.style.right = 100 - ((maxDot - this.pricesList.min) / (maxRangeDot.max - this.pricesList.min)) * 100 + "%";
    }
}

export function updateSliderPrice() {
    const rangeMin = 0
    const range = this.$refs.range

    let minRangeDot = this.$refs.rangeMin
    let maxRangeDot = this.$refs.rangeMax

    let minRangeValue = this.$refs.priceMin
    let maxRangeValue = this.$refs.priceMax

    let minValue = parseInt(minRangeValue.value)
    let maxValue = parseInt(maxRangeValue.value)

    if (maxValue - minValue >= rangeMin) {
        if (event.target === minRangeValue) {
            minRangeDot.value = minValue;
            this.prices[0] = minValue;

            range.style.left = ((minRangeDot.value - this.pricesList.min) / (minRangeDot.max - this.pricesList.min)) * 100 + "%";
        } else {
            maxRangeDot.value = maxValue;
            this.prices[1] = maxValue;

            range.style.right = 100 - ((maxRangeDot.value -this.pricesList.min) / (maxRangeDot.max - this.pricesList.min)) * 100 + "%";
        }
    }
}
