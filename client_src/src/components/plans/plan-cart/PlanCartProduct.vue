<template>
  <div>
    <v-row>
      <PlansHeader
        :title="'Your box cart'"
        :step="step"
        @back="$emit('back')"
      />
      <p class="font__description">
        Your plan:
      </p>
    </v-row>
    <PlanCartDescription
      :name="tmpCurrentPlan.name"
      :benefits="tmpCurrentPlan.benefits"
      :cost="tmpCurrentPlan.cost"
      @customize="$emit('customize')"
    />
    <PlanCartSummary
      :selected-plan-free-shipping-from="tmpCurrentPlan.freeShippingFrom"
      :overal-price="overalPrice"
    />
    <div
      v-if="tmpCurrentPlan.products.length"
      class="plan-cart-products py-8"
    >
      <div
        v-for="(item, index) in tmpCurrentPlan.products"
        :key="index"
        class="plan-cart-product"
      >
        <v-row class="align-center">
          <v-col
            xs="12"
            sm="6"
            md="6"
            lg="2"
          >
            <div class="plan-cart-product__image-container">
              <img
                :src="require(`@/assets/products/${item.img}`)"
                alt="product"
                class="plan-cart-product__image"
              >
            </div>
          </v-col>
          <v-col
            sm="6"
            md="6"
            lg="6"
            class="plan-cart-product-description-product"
          >
            <p class="plan-cart-product-description-product__title font__title mb-3">
              {{ item.title }}
            </p>
            <p class="plan-cart-product-description-product__description mb-0">
              {{ item.description }}
            </p>
          </v-col>
          <v-col
            sm="6"
            md="6"
            lg="2"
          >
            <p class="plan-cart-product__price mb-0">
              <span
                class="plan-cart-product__price_small mr-1"
              >$</span>{{ item.price }}
            </p>
          </v-col>
          <v-col
            sm="6"
            md="6"
            lg="2"
            class="counter-products d-flex align-center"
          >
            <v-btn
              outlined
              height="49"
              min-width="49"
              width="49"
              color="#D9D9D9"
              class="counter-btn pa-0"
              depressed
              @click="decrement(index)"
            >
              -
            </v-btn>
            <input
              v-model="item.count"
              class="plan-cart-product__amount-number mb-0"
              type="number"
            >
            <v-btn
              outlined
              height="49"
              min-width="49"
              width="49"
              color="#D9D9D9"
              class="counter-btn pa-0"
              depressed
              @click="increment(index)"
            >
              +
            </v-btn>
            <v-btn
              icon
              class="ml-8"
              height="49"
              width="49"
            >
              <img
                src="@/assets/plans/benefits/close.png"
                alt="close"
                @click="deleteProduct(index)"
              >
            </v-btn>
          </v-col>
        </v-row>
      </div>
    </div>
    <div v-else>
      <h2 class="font__title mt-4 mb-16">
        No Products
      </h2>
    </div>
    <div class="text-right my-10">
      <span class="overall-price__text mb-1 mr-4">Overal:</span>
      <span class="overall-price__price mb-0">
        <span class="overall-price__price_small mr-1">$</span>
        {{ overalPrice }}
      </span>
    </div>
    <div class="overall-price d-flex align-center justify-end">
      <p>
        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Asperiores consequuntur cumque dolore earum
        error harum laborum perspiciatis quasi
      </p>
      <v-btn
        v-if="step !== 1"
        rounded
        outlined
        color="#efb60f"
        width="170"
        height="52"
        depressed
        class="custom-btn custom-btn--checkout ml-auto mr-12"
        @click="onCheckout"
      >
        Checkout
      </v-btn>
    </div>
  </div>
</template>

<script>
import { mapState, mapMutations } from 'vuex';
import PlansHeader from '@/components/plans/PlansHeader';
import PlanCartDescription from '@/components/plans/plan-cart/PlanCartDescription';
import PlanCartSummary from '@/components/plans/plan-cart/PlanCartSummary';

export default {
  name: 'PlanCartProduct',
  components: {
    PlansHeader,
    PlanCartDescription,
    PlanCartSummary
  },
  props: {
    selectedPlanId: {
      type: [String, Number],
      default: ''
    },
    step: {
      type: Number,
      default: null
    }
  },
  computed: {
    ...mapState({
      plansData: state => state.plansData
    }),
    overalPrice() {
      return this.tmpCurrentPlan.products.reduce((sum, item) => sum + (item.count * item.price), 0).toFixed(2);
    }
  },
  data: () => ({
    choose: false,
    tmpCurrentPlan: {}
  }),
  created() {
    const item = this.plansData.find(item => item.id === this.selectedPlanId);
    this.tmpCurrentPlan = JSON.parse(JSON.stringify(item));
  },
  methods: {
    ...mapMutations({
      checkout: 'checkout'
    }),
    increment(index) {
      this.tmpCurrentPlan.products[index].count++;
    },
    decrement(index) {
      const item = this.tmpCurrentPlan.products[index];
      item.count > 1 ? item.count-- : '';
    },
    deleteProduct(index) {
      this.tmpCurrentPlan.products.splice(index, 1);
    },
    async onCheckout() {
      try {
        await this.checkout(this.tmpCurrentPlan);
        await this.$emit('checkout', this.tmpCurrentPlan);
      } catch (e) {
        console.error(e);
      }
    }
  }
};
</script>
