<template>
  <section>
    <v-container>
      <PlansHeader
        :title="'Choose box type'"
        :description="'We noticed which products you viewed and based on this we suggest choosing a box'"
        :step="step"
        @back="$emit('back')"
        @custom="$emit('custom')"
      />
      <v-row
        class="plan-items"
        justify="space-around"
      >
        <v-col
          v-for="(item, index) in plansData"
          :key="index"
          xs="12"
          sm="12"
          md="12"
          lg="4"
          class="my-5"
        >
          <PlansItem
            :id="item.id"
            :custom="item.custom"
            :updated-plan="item.updated"
            :img="item.img"
            :name="item.name"
            :description="item.description"
            :cost="item.cost"
            :index="index"
            :benefits="item.benefits"
            @select-plan="selectPlan"
          />
        </v-col>
      </v-row>
      <p class="font__small-description">
        * Lorem Ipsum is simply dummy text of the printing and
        typesetting industry. Lorem Ipsum has been the industry's
        standard dummy text ever since the
      </p>
    </v-container>
  </section>
</template>

<script>
import PlansHeader from '@/components/plans/PlansHeader';
import PlansItem from '@/components/plans/plans-wrapper/PlansItem';
import { mapState, mapMutations } from 'vuex';

export default {
  name: 'PlansWrapper',
  components: {
    PlansHeader,
    PlansItem
  },
  props: {
    step: {
      type: Number,
      default: null
    }
  },
  computed: {
    ...mapState({
      plansData: state => state.plansData
    })
  },
  methods: {
    ...mapMutations(["setBoxes"]),
    selectPlan(id) {
      this.$emit('select-plan', id);
    },
    fetchAllBoxies() {
      this.$axios.get('http://127.0.0.1:8000/api/boxes')
        .then(res => {
            this.setBoxes(res.data);
            console.log(res.data);
        })
        .catch((error) => {
            console.log(error.response);
        });
    }
  },
  created() {
    this.fetchAllBoxies();
  }
};
</script>
