<template>
  <div class="col-12 col-lg-6">
    <div
      class="
        app-card app-card-account
        shadow-sm
        d-flex
        flex-column
        align-items-start
      "
    >
      <div class="app-card-header p-3 border-bottom-0">
        <div class="row align-items-center gx-3">
          <div class="col-auto">
            <div class="app-icon-holder">
              <svg
                width="1em"
                height="1em"
                viewBox="0 0 16 16"
                class="bi bi-credit-card"
                fill="currentColor"
                xmlns="http://www.w3.org/2000/svg"
              >
                <path
                  fill-rule="evenodd"
                  d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4zm2-1a1 1 0 0 0-1 1v1h14V4a1 1 0 0 0-1-1H2zm13 4H1v5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V7z"
                />
                <path
                  d="M2 10a1 1 0 0 1 1-1h1a1 1 0 0 1 1 1v1a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1v-1z"
                />
              </svg>
            </div>
            <!--//icon-holder-->
          </div>
          <!--//col-->
          <div class="col-auto">
            <h4 class="app-card-title">Payment methods</h4>
          </div>
          <!--//col-->
        </div>
        <!--//row-->
      </div>
      <!--//app-card-header-->
      <div class="app-card-body px-4 w-100">
        <div class="item border-bottom py-3">
          <div class="row justify-content-between align-items-center">
            <div class="col-auto">
              <div class="item-label">
                <i class="fab fa-cc-visa me-2"></i
                ><strong>Credit/Debit Card </strong>
              </div>
              <div class="item-data">1234*******5678</div>
            </div>
            <!--//col-->
            <div class="col text-end">
              <a class="btn-sm app-btn-secondary" href="#">Edit</a>
            </div>
            <!--//col-->
          </div>
          <!--//row-->
        </div>
        <!--//item-->
        <div class="item border-bottom py-3">
          <div class="row justify-content-between align-items-center">
            <div class="col-auto">
              <div class="item-label">
                <i class="fab fa-paypal me-2"></i><strong>PayPal</strong>
              </div>
              <div class="item-data">Not connected</div>
            </div>
            <!--//col-->
            <div class="col text-end">
              <a class="btn-sm app-btn-secondary" href="#">Connect</a>
            </div>
            <!--//col-->
          </div>
          <!--//row-->
        </div>
        <!--//item-->
      </div>
      <!--//app-card-body-->
      <div class="app-card-footer p-4 mt-auto">
        <a class="btn app-btn-secondary" href="#">Manage Payment</a>
      </div>
      <!--//app-card-footer-->
    </div>
    <!--//app-card-->
  </div>
</template>

<script>
export default {};
</script>

<style>
</style>