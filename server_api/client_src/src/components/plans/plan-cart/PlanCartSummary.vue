<template>
  <v-row class="plan-cart-summary">
    <v-col sm="4">
      <p class="font__description">
        Summary of the package:
      </p>
    </v-col>
    <v-col sm="6">
      <div class="plan-cart-summary-box ml-auto mr-14">
        <p
          v-if="shippingPrice > 0"
          class="plan-cart-summary__shipping-text text--primary mb-0"
        >
          If you are would like free shipping you are left:
          <span class="plan-cart-summary__number">
            <span class="plan-cart-summary__number_small mr-1">$</span>
            {{ shippingPrice }}
          </span>
        </p>
        <p
          v-else
          class="plan-cart-summary__shipping-text text--primary mb-0"
        >
          You already have free shipping
        </p>
      </div>
    </v-col>
    <v-col sm="2">
      <div class="plan-cart-summary__timer d-flex">
        <div class="d-flex flex-column">
          <p class="plan-cart-summary__number mx-auto">
            {{ minute }}
          </p>
          <span class="plan-cart-summary__shipping-text text--secondary">Minute</span>
        </div>
        <span class="plan-cart-summary__number mx-4">:</span>
        <div class="d-flex flex-column">
          <p class="plan-cart-summary__number mx-auto">
            {{ seconds }}
          </p>
          <span class="plan-cart-summary__shipping-text text--secondary">Second</span>
        </div>
      </div>
    </v-col>
  </v-row>
</template>

<script>
export default {
  name: 'PlanCartSummary',
  props: {
    selectedPlanFreeShippingFrom: {
      type: [Number, String],
      default: null
    },
    overalPrice: {
      type: String,
      default: ''
    }
  },
  data: () => ({
    seconds: '44',
    minute: '03'
  }),
  computed: {
    shippingPrice() {
      const diff = Number(this.selectedPlanFreeShippingFrom) - +this.overalPrice;
      return diff >= 0 ? diff.toFixed(2) : 0;
    }
  }
};
</script>
