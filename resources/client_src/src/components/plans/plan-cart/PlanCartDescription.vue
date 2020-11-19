<template>
  <div class="plan-cart-description">
    <v-row>
      <v-col
        sm="12"
        lg="3"
        class="d-flex"
      >
        <h3 class="plan-cart-description__title color-yellow mr-6">
          {{ name }}
        </h3>
        <p class="font__price mb-0 mr-16">
          <span class="font__price_small mr-1">$</span>{{ cost }}
        </p>
      </v-col>
      <v-col
        sm="12"
        lg="6"
      >
        <div class="plan-cart-description__benefits d-flex flex-wrap">
          <div
            v-for="item in benefits"
            :key="item.id"
            class="d-flex align-center mb-4"
          >
            <img
              :src="getSrc('benefits/'+item.image)"
              :alt="item.name"
            >
            <p class="plan-cart-description__paragraph mr-4 mb-0 ml-4">
              {{ item.name }}
            </p>
          </div>
        </div>
      </v-col>
      <v-col
        sm="12"
        lg="3"
      >
        <p
          class="plan-cart-description__paragraph color-yellow ml-auto mb-0 pointer text-lg-right"
          @click="$emit('customize')"
        >
          Customize
        </p>
      </v-col>
    </v-row>
  </div>
</template>

<script>

export default {
  name: 'PlanCartDescription',
  props: {
    name: {
      type: String,
      default: ''
    },
    benefits: {
      type: Array,
      default: () => []
    },
    cost: {
      type: Number,
      default: null
    }
  },
  methods: {
    getSrc(src) {
      return require(`@/assets/plans/${src}`)
    }
  }

};
</script>
