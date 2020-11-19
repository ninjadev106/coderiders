<template>
  <div class="plan-checkout">
    <h2 class="plan-checkout__text mb-14">
      Number of your order: {{ hardDate }}
    </h2>
    <img
      src="@/assets/plans/checkout/company.svg"
      alt=""
    >
    <p class="plan-checkout__text mt-14">
      Your order was checked out successfully!
    </p>
    <v-row justify="center">
      <v-btn
        rounded
        outlined
        color="#efb60f"
        width="170"
        height="52"
        depressed
        class="custom-btn"
        @click="$emit('go-to-plans')"
      >
        Go to plans
      </v-btn>
    </v-row>
  </div>
</template>

<script>
import { mapState } from 'vuex';

export default {
  name: 'Checkout',
  data: () => ({
    hardDate: '91203902'
  }),
  computed: {
    ...mapState({
      plansData: state => state.plansData
    })
  }
};
</script>
