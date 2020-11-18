<template>
  <section>
    <v-container>
      <component
        :is="selectedComponent"
        :step="step"
        :selected-plan-id="selectedPlanId"
        @select-plan="selectPlan"
        @back="back"
        @customize="customize"
        @checkout="checkout"
        @save-changes="saveChanges"
        @go-to-plans="goToPlans"
        @custom="showCreateForm"
      />
    </v-container>
  </section>
</template>

<script>
import PlansWrapper from '@/components/plans/plans-wrapper/PlansWrapper';
import PlanCartProduct from '@/components/plans/plan-cart/PlanCartProduct';
import EditPlan from '@/components/editPlan/EditPlan';
import CreatePlan from '@/components/addPlan/CreatePlan';
import Checkout from '@/components/plans/Checkout';

export default {
  name: 'Plans',
  components: {
    PlansWrapper,
    PlanCartProduct,
    EditPlan,
    CreatePlan,
    Checkout
  },
  data: () => ({
    selectedComponent: 'PlansWrapper',
    selectedPlanId: null,
    planChecked: false,
    timer: ''
  }),
  computed: {
    step() {
      return this.selectedComponent === 'PlansWrapper' ? 1 : 2;
    }
  },
  methods: {
    showCreateForm() {
        this.selectedComponent = 'CreatePlan';
    },
    selectPlan(id) {
      this.selectedPlanId = id;
      this.selectedComponent = 'PlanCartProduct';
    },
    back() {
      this.selectedComponent = 'PlansWrapper';
    },
    customize() {
      this.selectedComponent = 'EditPlan';
    },
    checkout() {
      this.selectedComponent = 'Checkout';
    },
    saveChanges() {
      this.selectedComponent = 'PlansWrapper';
    },
    goToPlans() {
      this.selectedComponent = 'PlansWrapper';
    }
  }
};
</script>
