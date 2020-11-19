<template>
  <div class="prompt mb-10">
    <div class="prompt__description">
      <h2 class="font__title mb-3">
        {{ title }}
      </h2>
      <p
        v-if="description"
        class="font__description mb-0"
      >
        {{ description }}
      </p>

      <div class="mt-3">
        <v-btn
            v-if="step !== 2"
            rounded
            outlined
            color="#efb60f"
            width="170"
            height="52"
            depressed
            class="custom-btn custom-btn--checkout"
            @click="$emit('custom')"
        >
          Create custom
        </v-btn>
      </div>
    </div>
    <v-btn
      v-if="step !== 1"
      rounded
      outlined
      color="#1D2025"
      width="170"
      height="52"
      depressed
      class="custom-btn custom-btn--back ml-auto mr-12"
      @click="$emit('back')"
    >
      Back
    </v-btn>
    <p class="font__title mb-0 white-space-nowrap">
      Step {{ step }} / 2
    </p>
  </div>
</template>

<script>
export default {
  name: 'PlansHeader',
  props: {
    title: {
      type: String,
      default: ''
    },
    description: {
      type: String,
      default: ''
    },
    step: {
      type: Number,
      default: null
    }
  }
};
</script>
