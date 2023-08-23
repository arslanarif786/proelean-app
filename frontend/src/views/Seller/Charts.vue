<template>
  <div class="container-xl">
     <h1 class="app-page-title">Charts</h1>
       <div class="row g-4 mb-4">
    <WhiteCard/>
    <AreaLineChart/>
    <BarChart/>
    <PieChart/>
    <DoughnutChart/>
    </div>
  </div>
</template>

<script>
import WhiteCard from "../../components/Seller/Charts/WhiteCard.vue";
import BarChart from "../../components/Seller/Charts/BarChart.vue";
import PieChart from "../../components/Seller/Charts/PieChart.vue";
import DoughnutChart from "../../components/Seller/Charts/DoughnutChart.vue";

export default {
  components:{ WhiteCard, BarChart, PieChart, DoughnutChart }
}
</script>