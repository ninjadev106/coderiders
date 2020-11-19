<template>
  <section class="edit-plan">
    <PlansHeader
      :title="'Create custom plan'"
      :step="step"
      @back="$emit('back')"
    />

  <v-row>
    <v-col
      xs="12"
      sm="5"
    >
      <span class="plan-title">{{ name }}</span>
      <span class="font__price"><sub>$</sub>{{ boxCost }}</span>
    </v-col>
  </v-row>

  <v-row>
    <v-col cols="12" md="6">
      <v-text-field
        v-model="name"
        :counter="10"
        :rules="nameRules"
        label="Name"
        required
      ></v-text-field>
    </v-col>
  </v-row>

  <v-row>
    <v-col cols="12" md="6">
      <v-textarea
        v-model="description"
        name="input-7-1"
        label="Default style"
        hint="Hint text"
        :rules="descriptionRules"
      ></v-textarea>
    </v-col>
  </v-row>

  <hr class="my-10">

  <v-row>
    <v-col
      sm="10"
      class="benefits-container"
    >
      <v-row
        v-for="item in benefits"
        :key="item.id"
        class="benefits-item"
      >
        <v-col sm="2">
        <img
          :src="getSrc('benefits/'+item.image)"
          :alt="item.name"
        />
        </v-col>
        <v-col sm="7">
          {{ item.name }}
        </v-col>
        <v-col
                sm="1"
        >
          <v-checkbox
            v-model="item.checked"
            color="#EFB60F"
            @change="onCheckBoxChange(item.checked, item.cost)"
          ></v-checkbox>
        </v-col>
        <v-col sm="2">
        </v-col>
      </v-row>
    </v-col>

    <v-col sm="3">
      <v-select
        v-model="resubscribePeriodValue"
        outlined
        width="162"
        height="40"
        :items="resubscribePeriod.periods"
      ></v-select>
    </v-col>
  </v-row>

  <hr class="my-10">

    <div
      v-if="products.length"
      class="plan-cart-products py-8"
    >
      <div
        v-for="(item, index) in products"
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
                :src="getProductSrc(item.img)"
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
              <span class="plan-cart-product__price_small mr-1">$</span>{{ item.price }}
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
    <v-btn
      rounded
      outlined
      color="#1D2025"
      width="170"
      height="52"
      depressed
      class="custom-btn custom-btn--back ml-auto mr-12"
      @click="createBox"
    >
      Create
    </v-btn>
  </div>


  </section>
</template>

<script>
import { mapMutations } from 'vuex';
import PlansHeader from '@/components/plans/PlansHeader';
import _ from 'lodash';

export default {
  name: 'CreatePlan',
  components: {
    PlansHeader
  },
  props: {
    step: {
      type: [Number, String],
      default: null
    },
  },
  computed: {
      overalPrice() {
          return this.products.reduce((sum, item) => sum + (item.count * item.price), 0).toFixed(2);
      },
      boxCost() {
          if (typeof this.benefits === 'undefined') {
              return 0;
          }

          const benefitsCopy = this.benefits.filter(item => {
              return typeof item.checked !== 'undefined' && item.checked;
          });

          if (typeof benefitsCopy === 'undefined' || !benefitsCopy.length) {
              return 0;
          }

          let cost = 0;

          benefitsCopy.forEach(item => {
              cost += Number(item.cost)
          });

          return cost.toFixed(2)
      }
  },
  data: () => ({
    name: '',
    description: '',
    tmpCost: null,
    tmpCurrentPlan: {},
    resubscribePeriodValue: '',
    benefits: [],
    products: [],
    resubscribePeriod: {
      img: 'clock_icon.svg',
      name: 'want to receive a given box with',
      periods: ['every 1 months', 'every 2 months', 'every 3 months']
    },
    nameRules: [
      v => {
          if (v) {
              return true;
          } else {
              return "Title is required";
          }
      }
    ],
    descriptionRules: [
        v => {
            if (v) {
                return true;
            } else {
                return "Description is required";
            }
        }
    ],
  }),

  methods: {
    ...mapMutations({
      addBox: 'addBox',
    }),
    onCheckBoxChange(checked, cost) {
      checked ? this.tmpCost += Number(cost) : this.tmpCost -= Number(cost);
    },
    increment(index) {
        this.products[index].count++;
    },
    decrement(index) {
        const item = this.products[index];
        item.count > 1 ? item.count-- : '';
    },
    deleteProduct(index) {
        this.products.splice(index, 1);
    },
    fetchBenefits() {
      this.$axios
        .get("http://127.0.0.1:8000/api/benefits")
        .then(res => {
            this.benefits = res.data;
        })
        .catch(err => console.error(err.response.data));
    },
    fetchProducts() {
        this.$axios
          .get("http://127.0.0.1:8000/api/products")
          .then(res => {
              this.products = _.cloneDeep(res.data);
          })
          .catch(err => console.error(err.response.data));
    },
    getSrc(src) {
      return require(`@/assets/plans/${src}`)
    },
    getProductSrc(src) {
      return require(`@/assets/products/${src}`);
    },
    createBox() {
        const token = localStorage.getItem("token");
        const headers =  {"Authorization": `Bearer ${token}`};
        const checkedBenefits = this.benefits.filter(item => item.checked);

        const reqData = {
            name: this.name,
            description: this.description,
            benefitIds : checkedBenefits.map((b) => b.id),
            products :  this.products.filter(item => item.count !== null && item.count > 0),
            resubscribePeriod : this.resubscribePeriodValue,
        };

        this.$axios
            .post("http://127.0.0.1:8000/api/boxes/custom", reqData, headers)
            .then(res => {
                this.addBox(res.data);
                this.$emit('save-changes');
            })
            .catch(err => console.error(err.response.data));
    }
  },
  created() {
    this.fetchBenefits();
    this.fetchProducts();
  },
};
</script>

<style>
</style>
