<template>
  <div class="row g-4 settings-section">
    <div class="col-12 col-md-4">
      <h3 class="section-title">Notifications</h3>
      <div class="section-intro">
        Settings section intro goes here. Duis velit massa, faucibus non
        hendrerit eget.
      </div>
    </div>
    <div class="col-12 col-md-8">
      <div class="app-card app-card-settings shadow-sm p-4">
        <div class="app-card-body">
          <form class="settings-form">
            <div class="form-check form-switch mb-3">
              <input
                class="form-check-input"
                type="checkbox"
                id="settings-switch-1"
                checked
              />
              <label class="form-check-label" for="settings-switch-1"
                >Project notifications</label
              >
            </div>
            <div class="form-check form-switch mb-3">
              <input
                class="form-check-input"
                type="checkbox"
                id="settings-switch-2"
              />
              <label class="form-check-label" for="settings-switch-2"
                >Web browser push notifications</label
              >
            </div>
            <div class="form-check form-switch mb-3">
              <input
                class="form-check-input"
                type="checkbox"
                id="settings-switch-3"
                checked
              />
              <label class="form-check-label" for="settings-switch-3"
                >Mobile push notifications</label
              >
            </div>
            <div class="form-check form-switch mb-3">
              <input
                class="form-check-input"
                type="checkbox"
                id="settings-switch-4"
              />
              <label class="form-check-label" for="settings-switch-4"
                >Lorem ipsum notifications</label
              >
            </div>
            <div class="form-check form-switch mb-3">
              <input
                class="form-check-input"
                type="checkbox"
                id="settings-switch-5"
              />
              <label class="form-check-label" for="settings-switch-5"
                >Lorem ipsum notifications</label
              >
            </div>
            <div class="mt-3">
              <button type="submit" class="btn app-btn-primary">
                Save Changes
              </button>
            </div>
          </form>
        </div>
        <!--//app-card-body-->
      </div>
      <!--//app-card-->
    </div>
  </div>
</template>

<script>
export default {};
</script>

<style>
</style>