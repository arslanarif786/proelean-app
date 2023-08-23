<template>
  <div class="app-card app-card-orders-table shadow-sm my-3 p-3">
    <div class="row g-3  align-items-center justify-content-between">
      <div class="col-auto">
        <h1 class="app-page-title mb-0">Active Orders</h1>
      </div>
      <div class="col-auto">
        <div class="page-utilities">
          <div
            class="
              row
              g-2
              justify-content-start justify-content-md-end
              align-items-center
            "
          >
         
            <!--//col-->
            <div class="col-auto">
              <select class="form-select w-auto">
                <option selected="" value="option-1">Active Orders (3)</option>
                <option value="option-3">Completed</option>
                <option value="option-4">Canceled</option>
              </select>
            </div>
          
          </div>
          <!--//row-->
        </div>
        <!--//table-utilities-->
      </div>
      <!--//col-auto-->
    </div>
  </div>
</template>

<script>
export default {};
</script>

<style scoped>
.form-select {
    display: block;
    width: 100%;
    height: calc(1.5em + 0.75rem + 2px);
    padding: 0.375rem 1.75rem 0.375rem 0.75rem;
    font-size: 15px;
    font-weight: 400;
    line-height: 1.5;
    color: #495057;
    background-color: #fff;
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='%23343a40' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M2 5l6 6 6-6'/%3e%3c/svg%3e");
    background-repeat: no-repeat;
    background-position: right 0.75rem center;
    background-size: 16px 12px;
    border: 1px solid #ced4da;
    border-radius: 0.25rem;
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
}
.form-select:focus {
    border-color: #8bbafe;
    outline: 0;
    box-shadow: 0 0 0 0.25rem rgb(13 110 253 / 25%);
}
</style>