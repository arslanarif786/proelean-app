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
                class="bi bi-sliders"
                fill="currentColor"
                xmlns="http://www.w3.org/2000/svg"
              >
                <path
                  fill-rule="evenodd"
                  d="M11.5 2a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3zM9.05 3a2.5 2.5 0 0 1 4.9 0H16v1h-2.05a2.5 2.5 0 0 1-4.9 0H0V3h9.05zM4.5 7a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3zM2.05 8a2.5 2.5 0 0 1 4.9 0H16v1H6.95a2.5 2.5 0 0 1-4.9 0H0V8h2.05zm9.45 4a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3zm-2.45 1a2.5 2.5 0 0 1 4.9 0H16v1h-2.05a2.5 2.5 0 0 1-4.9 0H0v-1h9.05z"
                />
              </svg>
            </div>
            <!--//icon-holder-->
          </div>
          <!--//col-->
          <div class="col-auto">
            <h4 class="app-card-title">Preferences</h4>
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
              <div class="item-label"><strong>Language </strong></div>
              <div class="item-data">English</div>
            </div>
            <!--//col-->
            <div class="col text-end">
              <a class="btn-sm app-btn-secondary" href="#">Change</a>
            </div>
            <!--//col-->
          </div>
          <!--//row-->
        </div>
        <!--//item-->
        <div class="item border-bottom py-3">
          <div class="row justify-content-between align-items-center">
            <div class="col-auto">
              <div class="item-label"><strong>Time Zone</strong></div>
              <div class="item-data">Central Standard Time (UTC-6)</div>
            </div>
            <!--//col-->
            <div class="col text-end">
              <a class="btn-sm app-btn-secondary" href="#">Change</a>
            </div>
            <!--//col-->
          </div>
          <!--//row-->
        </div>
        <!--//item-->
        <div class="item border-bottom py-3">
          <div class="row justify-content-between align-items-center">
            <div class="col-auto">
              <div class="item-label"><strong>Currency</strong></div>
              <div class="item-data">$(US Dollars)</div>
            </div>
            <!--//col-->
            <div class="col text-end">
              <a class="btn-sm app-btn-secondary" href="#">Change</a>
            </div>
            <!--//col-->
          </div>
          <!--//row-->
        </div>
        <!--//item-->
        <div class="item border-bottom py-3">
          <div class="row justify-content-between align-items-center">
            <div class="col-auto">
              <div class="item-label"><strong>Email Subscription</strong></div>
              <div class="item-data">Off</div>
            </div>
            <!--//col-->
            <div class="col text-end">
              <a class="btn-sm app-btn-secondary" href="#">Change</a>
            </div>
            <!--//col-->
          </div>
          <!--//row-->
        </div>
        <!--//item-->
        <div class="item border-bottom py-3">
          <div class="row justify-content-between align-items-center">
            <div class="col-auto">
              <div class="item-label"><strong>SMS Notifications</strong></div>
              <div class="item-data">On</div>
            </div>
            <!--//col-->
            <div class="col text-end">
              <a class="btn-sm app-btn-secondary" href="#">Change</a>
            </div>
            <!--//col-->
          </div>
          <!--//row-->
        </div>
        <!--//item-->
      </div>
      <!--//app-card-body-->
      <div class="app-card-footer p-4 mt-auto">
        <a class="btn app-btn-secondary" href="#">Manage Preferences</a>
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