<template>
  <div class="row g-4 settings-section">
    <div class="col-12 col-md-4">
      <h3 class="section-title">Data &amp; Privacy</h3>
      <div class="section-intro">
        Settings section intro goes here. Morbi vehicula, est eget fermentum
        ornare.
      </div>
    </div>
    <div class="col-12 col-md-8">
      <div class="app-card app-card-settings shadow-sm p-4">
        <div class="app-card-body">
          <form class="settings-form">
            <div class="form-check mb-3">
              <input
                class="form-check-input"
                type="checkbox"
                value=""
                id="settings-checkbox-1"
                checked
              />
              <label class="form-check-label" for="settings-checkbox-1">
                Keep user app activity history
              </label>
            </div>
            <!--//form-check-->
            <div class="form-check mb-3">
              <input
                class="form-check-input"
                type="checkbox"
                value=""
                id="settings-checkbox-2"
                checked
              />
              <label class="form-check-label" for="settings-checkbox-2">
                Keep user app preferences
              </label>
            </div>
            <div class="form-check mb-3">
              <input
                class="form-check-input"
                type="checkbox"
                value=""
                id="settings-checkbox-3"
              />
              <label class="form-check-label" for="settings-checkbox-3">
                Keep user app search history
              </label>
            </div>
            <div class="form-check mb-3">
              <input
                class="form-check-input"
                type="checkbox"
                value=""
                id="settings-checkbox-4"
              />
              <label class="form-check-label" for="settings-checkbox-4">
                Lorem ipsum dolor sit amet
              </label>
            </div>
            <div class="form-check mb-3">
              <input
                class="form-check-input"
                type="checkbox"
                value=""
                id="settings-checkbox-5"
              />
              <label class="form-check-label" for="settings-checkbox-5">
                Aenean quis pharetra metus
              </label>
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