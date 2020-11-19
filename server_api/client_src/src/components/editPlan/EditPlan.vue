<template>
  <section class="edit-plan">
    <PlansHeader
      :title="'Customise your plan'"
      :step="step"
      @back="$emit('back')"
    />
    <v-row>
      <v-col sm="3">
        <img
          src="@/assets/editPlanImage.svg"
          alt="edit plan image"
        />
      </v-col>
      <v-col sm="9">
        <v-row>
          <v-col
            sm="6"
            class="info-text"
          >
            Your plan:
          </v-col>
          <v-col sm="6"></v-col>
        </v-row>
        <v-row>
          <v-col
            xs="12"
            sm="5"
          >
            <span class="plan-title">{{ tmpCurrentPlan.name }}</span><span
              class="font__price"
            ><sub>$</sub>{{ tmpCurrentPlan.cost }}</span>
          </v-col>
          <v-col
            xs="12"
            sm="6"
          >
            <v-row>
              <v-col
                sm="7"
              >
                <a
                  href="#"
                  class="yellow-link"
                  @click="saveAsCustom"
                >Save as custom box</a>
              </v-col>
              <v-col
                sm="5"
              >
                <a
                  href="#"
                  class="yellow-link"
                  @click="$emit('back')"
                >Change plan</a>
              </v-col>
            </v-row>
          </v-col>
          <v-col sm="1"></v-col>
        </v-row>
        <v-row>
          <v-col
            sm="6"
            class="info-text"
          >
            Benefits:
          </v-col>
          <v-col sm="6"></v-col>
        </v-row>
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
        </v-row>
        <v-row>
          <v-col sm="12">
            <v-row class="benefits-item">
              <v-col sm="1">
                <img
                  :src="
                    require(`@/assets/plans/benefits/${resubscribePeriod.img}`)
                  "
                  alt="resubscribePeriod.name"
                />
              </v-col>
              <v-col
                sm="4"
                class="edit-plan__bottom-text"
              >
                {{
                  resubscribePeriod.name
                }}
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
              <v-col sm="4"></v-col>
            </v-row>
          </v-col>
        </v-row>
      </v-col>
    </v-row>
    <div class="d-flex justify-end align-center my-7">
      <span class="mr-2">Updated price:</span>
      <span class="font__price"><sub>$</sub>{{ tmpCost }}</span>
    </div>
    <v-row>
      <v-btn
        v-if="step !== 1"
        rounded
        outlined
        color="#efb60f"
        width="170"
        height="52"
        depressed
        class="custom-btn custom-btn--checkout ml-auto"
        @click="updateCardHandler"
      >
        Save Changes
      </v-btn>
      <v-btn
        v-if="step !== 1"
        rounded
        outlined
        color="#1D2025"
        width="170"
        height="52"
        depressed
        class="custom-btn custom-btn--back ml-4"
        @click="$emit('back')"
      >
        Cancel and Back
      </v-btn>
    </v-row>
  </section>
</template>

<script>
import { mapState, mapMutations } from 'vuex';
import PlansHeader from '@/components/plans/PlansHeader';

export default {
  name: 'EditPlan',
  components: {
    PlansHeader
  },
  props: {
    step: {
      type: [Number, String],
      default: null
    },
    selectedPlanId: {
      type: [Number, String],
      default: ''
    }
  },
  computed: {
    ...mapState({
      plansData: state => state.plansData
    })
  },
  data: () => ({
    tmpCost: null,
    tmpCurrentPlan: {},
    resubscribePeriodValue: '',
    benefits: [],
    resubscribePeriod: {
      img: 'clock_icon.svg',
      name: 'want to receive a given box with',
      periods: ['every 1 months', 'every 2 months', 'every 3 months']
    }
  }),
  created() {
    const item = this.plansData.find(item => item.id === this.selectedPlanId);
    this.fetchBenefits();
    this.tmpCurrentPlan = JSON.parse(JSON.stringify(item));
    this.resubscribePeriodValue = this.tmpCurrentPlan.resubscribePeriod;
    this.tmpCost = this.tmpCurrentPlan.cost;
  },
  methods: {
    ...mapMutations({
      updateCard: 'updateCard',
      addBox: 'addBox',
    }),
    onCheckBoxChange(checked, cost) {
      checked ? this.tmpCost += Number(cost) : this.tmpCost -= Number(cost);
    },
    updateCardHandler() {
      this.tmpCurrentPlan.benefits = this.benefits.filter(item => item.checked);
      this.tmpCurrentPlan.cost = this.tmpCost;
      this.tmpCurrentPlan.resubscribePeriod = this.resubscribePeriodValue;
      this.updateCard(this.tmpCurrentPlan);
      this.$emit('save-changes');
    },
    saveAsCustom() {
      const token = localStorage.getItem("token");
      const headers =  {"Authorization": `Bearer ${token}`};
      const checkedBenefits = this.benefits.filter(item => item.checked );
      const reqData = {
        boxId : this.tmpCurrentPlan.id,
        benefitIds : checkedBenefits.map((b) => b.id),
        products :  this.tmpCurrentPlan.products,
        resubscribePeriod : this.resubscribePeriodValue,
      }

      this.$axios
      .post("http://127.0.0.1:8000/api/boxes", reqData, headers)
      .then(res => {
        this.addBox(res.data);
        this.$emit('save-changes');
      })
      .catch(err => console.error(err.response.data));
    },
    fetchBenefits() {
      this.$axios
        .get("http://127.0.0.1:8000/api/benefits")
        .then(res => {
            this.benefits = res.data;
            this.benefits.forEach((item, index) => {
              const isFind = this.tmpCurrentPlan.benefits.findIndex(currentItem => currentItem.name === item.name);
              if (isFind !== -1) {
                  this.benefits[index].checked = true;
                }
            });
        })
        .catch(err => console.error(err.response.data));
    },
    getSrc(src) {
      return require(`@/assets/plans/${src}`)
    }
  }
};
</script>

<style>
</style>
