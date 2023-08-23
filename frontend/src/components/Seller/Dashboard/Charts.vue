<template>
  <div class="row g-4 mb-4">
        <div class="col-12 col-lg-6 ">
      <div class="app-card app-card-chart h-100 shadow-sm">
        <div class="app-card-header p-3">
          <div class="row justify-content-between align-items-center">
            <div class="col-auto">
              <h4 class="app-card-title">{{ $t('dashboard.weeklyImpressions') }}</h4>
            </div>
            <!--//col-->
            <div class="col-auto">
              <div class="card-header-action">
                <span>12-12-2022 - today</span>
              </div>
              <!--//card-header-actions-->
            </div>
            <!--//col-->
          </div>
          <!--//row-->
        </div>
        <!--//app-card-header-->
        <div class="app-card-body p-3 p-lg-4">
          <div class="mb-3 d-flex">
            <!-- <select
              class="form-select form-select-sm ms-auto d-inline-flex w-auto"
            >
              <option value="1" selected>This week</option>
              <option value="2">Today</option>
              <option value="3">This Month</option>
              <option value="3">This Year</option>
            </select> -->
          </div>
          <div class="chart-container">
            <canvas id="canvas-barchart"></canvas>
          </div>
        </div>
        <!--//app-card-body-->
      </div>
      <!--//app-card-->
    </div>
    <!--//col-->
         <div class="col-12 col-lg-6">
      <div class="app-card app-card-progress-list h-100 shadow-sm">
        <div class="app-card-header p-3">
          <div class="row justify-content-between align-items-center">
            <div class="col-auto">
              <h4 class="app-card-title">{{ $t('dashboard.progress') }}</h4>
            </div>
            <!--//col-->
            <div class="col-auto">
              <div class="card-header-action">
                <div>{{ $t('dashboard.allProjects') }}</div>
              </div>
              <!--//card-header-actions-->
            </div>
            <!--//col-->
          </div>
          <!--//row-->
        </div>
        <!--//app-card-header-->
        <div class="app-card-body">
          <div class="item p-3">
            <div class="row align-items-center">
              <div class="col">
                <div class="title mb-1">{{ $t('dashboard.inboxResponseRate') }}</div>
                <div class="progress">
                  <div
                    class="progress-bar bg-success"
                    role="progressbar"
                    style="width: 100%"
                    aria-valuenow="100"
                    aria-valuemin="0"
                    aria-valuemax="100"
                  ></div>
                </div>
              </div>
              <!--//col-->
              <div class="col-auto">
            <p> 100%</p>
              </div>
              <!--//col-->
            </div>
            <!--//row-->
            <a class="item-link-mask" href="#"></a>
          </div>
          <!--//item-->

          <div class="item p-3">
            <div class="row align-items-center">
              <div class="col">
                <div class="title mb-1">
                  {{ $t('dashboard.orderResponseRate') }}
                </div>
                <div class="progress">
                  <div
                    class="progress-bar bg-success"
                    role="progressbar"
                    style="width: 100%"
                    aria-valuenow="100"
                    aria-valuemin="0"
                    aria-valuemax="100"
                  ></div>
                </div>
              </div>
              <!--//col-->
              <div class="col-auto">
            <p>100%</p>
              </div>
              <!--//col-->
            </div>
            <!--//row-->
            <a class="item-link-mask" href="#"></a>
          </div>
          <!--//item-->

          <div class="item p-3">
            <div class="row align-items-center">
              <div class="col">
                <div class="title mb-1">
                 {{ $t('dashboard.orderCompletion') }}
                </div>
                <div class="progress">
                  <div
                    class="progress-bar bg-danger"
                    role="progressbar"
                    style="width: 40%"
                    aria-valuenow="40"
                    aria-valuemin="0"
                    aria-valuemax="100"
                  ></div>
                </div>
              </div>
              <!--//col-->
              <div class="col-auto">
           <p>40%</p>
              </div>
              <!--//col-->
            </div>
            <!--//row-->
            <a class="item-link-mask" href="#"></a>
          </div>
          <!--//item-->

          <div class="item p-3">
            <div class="row align-items-center">
              <div class="col">
                <div class="title mb-1">
                 {{ $t('dashboard.deliveryTime') }}
                </div>
                <div class="progress">
                  <div
                    class="progress-bar bg-success"
                    role="progressbar"
                    style="width: 100%"
                    aria-valuenow="100"
                    aria-valuemin="0"
                    aria-valuemax="100"
                  ></div>
                </div>
              </div>
              <!--//col-->
              <div class="col-auto">
          <p>100%</p>
              </div>
              <!--//col-->
            </div>
            <!--//row-->
            <a class="item-link-mask" href="#"></a>
          </div>
          <!--//item-->
        </div>
       
        <!--//app-card-body-->
      </div>
      <!--//app-card-->
    </div>
    <!--//col-->

  </div>
</template>

<script>
import useChart from "@/composables/useChart.js";
//import { useStore } from 'vuex'
import { onMounted } from '@vue/runtime-core';
export default {
  setup() {
    //const store = useStore()
    useChart();

    onMounted(() => {
    
    });

    return {

    };
  },
};
</script>

<style>
</style>