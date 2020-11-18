<template>
  <div class="plans-item">
    <div class="plans-item-content">
      <v-chip
        v-if="custom"
        class="mt-4"
        color="#efb60f"
        text-color="white"
      >
        Custom
      </v-chip>
      <v-chip
        v-if="updatedPlan && !custom"
        class="mt-4"
        color="#efb60f"
        text-color="white"
      >
        Updated
      </v-chip>
      <div class="plan-benefits-wrapper">
        <img
          :src="getSrc('plans-item/'+img)"
          :alt="name"
          class="mb-4 plans-item-content__image"
        />
        <h3 class="plans-item-content__title">
          {{ name }}
        </h3>
        <p class="plans-item-content__description">
          {{ description }}
        </p>
        <p class="font__price">
          <span class="font__price_small">$</span>{{ cost }}
        </p>
        <div>
          <div
            v-for="(item, index) in benefits"
            :key="index"
            class="benefits-item"
          >
            <img
              :src="getSrc('benefits/'+item.image)"
              :alt="name"
            />
            <p class="plans-item-content__shipping color-yellow">
              {{ item.name }}
            </p>
          </div>
        </div>
      </div>
      <v-btn
        rounded
        outlined
        color="#1D2025"
        width="212"
        height="65"
        depressed
        class="custom-btn"
        @click="$emit('select-plan', id)"
      >
        Сhoose
        <img
          v-if="current"
          :src="check"
          alt="check"
          class="plans-item-check"
          height="60"
          width="60"
        >
      </v-btn>
    </div>
  </div>
</template>

<script>
import { mapState } from 'vuex';
import check from '@/assets/plans/plans-item/check.png';

export default {
  name: 'PlansItem',
  props: {
    custom: {
      type: Boolean,
      default: false
    },
    updatedPlan: {
      type: Boolean,
      default: false
    },
    id: {
      type: [String, Number],
      default: ''
    },
    img: {
      type: String,
      default: ''
    },
    name: {
      type: String,
      default: ''
    },
    description: {
      type: String,
      default: ''
    },
    cost: {
      type: Number,
      default: null
    },
    index: {
      type: Number,
      default: null
    },
    benefits: {
      type: Array,
      default: null
    }
  },
  data: () => ({
    check
  }),
  computed: {
    ...mapState({
      activePlanId: state => state.activePlanId
    }),
    current() {
      return this.activePlanId === this.id;
    }
  },
  methods: {
    getSrc(src) {
      return require(`@/assets/plans/${src}`)
    }
  }
};
</script>
