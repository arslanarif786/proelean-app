<template>
  <div
    class="
      app-card
      alert alert-dismissible
      shadow-sm
      mb-4
      border-left-decoration
    "
    role="alert"
  >
    <div class="inner">
      <div class="app-card-body p-3 p-lg-4">
        <h3 class="mb-3">{{ $t('dashboard.welcometoProelean') }}</h3>
        <div class="row gx-5 gy-3">
          <div class="col-12 col-lg-9">
            <div>
            {{ $t('dashboard.description') }}
            </div>
          </div>
          <!--//col-->
          <div class="col-12 col-lg-3">
            <a
              class="btn app-btn-primary"
              href="https://play.google.com/store/apps/details?id=com.horizam.pro.elean"
              target="_blank"
              ><svg
                width="1em"
                height="1em"
                viewBox="0 0 16 16"
                class="bi bi-file-earmark-arrow-down me-2"
                fill="currentColor"
                xmlns="http://www.w3.org/2000/svg"
              >
                <path
                  d="M4 0h5.5v1H4a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V4.5h1V14a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2z"
                />
                <path d="M9.5 3V0L14 4.5h-3A1.5 1.5 0 0 1 9.5 3z" />
                <path
                  fill-rule="evenodd"
                  d="M8 6a.5.5 0 0 1 .5.5v3.793l1.146-1.147a.5.5 0 0 1 .708.708l-2 2a.5.5 0 0 1-.708 0l-2-2a.5.5 0 1 1 .708-.708L7.5 10.293V6.5A.5.5 0 0 1 8 6z"
                /></svg
              > {{ $t('dashboard.downloadBtn') }}</a
            >
          </div>
          <!--//col-->
        </div>
        <!--//row-->
        <button
          type="button"
          class="btn-close btn-lrg-standard"
          data-bs-dismiss="alert"
          aria-label="Close"
         >
       <i class="fa fa-times" aria-hidden="true"></i>
        </button>
      </div>
      <!--//app-card-body-->
    </div>
    <!--//inner-->
  </div>
</template>

<script>
export default {};
</script>

<style scoped>

.seller-app .app-card .btn-close:focus {
    box-shadow: none;
    border: none;
    outline: none;
}

.btn-close {
    box-sizing: content-box;
    width: 1em;
    height: 1em;
    padding: 0.25em 0.25em;
    color: #000;
    background: transparent url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='%23000' viewBox='0 0 16 16'%3e%3cpath d='M.293.293a1 1 0 011.414 0L8 6.586 14.293.293a1 1 0 111.414 1.414L9.414 8l6.293 6.293a1 1 0 01-1.414 1.414L8 9.414l-6.293 6.293a1 1 0 01-1.414-1.414L6.586 8 .293 1.707a1 1 0 010-1.414z'/%3e%3c/svg%3e) no-repeat center center/1em auto");
    background-clip: content-box;
    border: 0;
    border-radius: 0.25rem;
    opacity: .5;
    font-size: 15px;
    font-weight: 100;
}
.seller-app .btn:hover,
.btn:active,
.btn:focus {
    color: #fff;
   
}

</style>