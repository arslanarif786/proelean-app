<template>
  <div class="app-card app-card-notification shadow-sm mb-4">
    <div class="app-card-header px-4 py-3">
      <div class="row g-3 align-items-center">
        <div class="col-12 col-lg-auto text-center text-lg-start">
          <img
            class="profile-image"
            src="/assets/seller/images/profiles/profile-3.png"
            alt=""
          />
        </div>
        <!--//col-->
        <div class="col-12 col-lg-auto text-center text-lg-start">
          <div class="notification-type mb-2">
            <span class="badge bg-success">News</span>
          </div>
          <h4 class="notification-title mb-1">
            Notification Heading Lorem Ipsum
          </h4>

          <ul class="notification-meta list-inline mb-0">
            <li class="list-inline-item">7 days ago</li>
            <li class="list-inline-item">|</li>
            <li class="list-inline-item">Kate Sanders</li>
          </ul>
        </div>
        <!--//col-->
      </div>
      <!--//row-->
    </div>
    <!--//app-card-header-->
    <div class="app-card-body p-4">
      <div class="notification-content">
        Sed tempor faucibus arcu, nec tristique erat congue sed. Pellentesque
        auctor ut elit vel feugiat. Sed a mauris tempor, tempor lacus vel,
        tristique metus. Nulla interdum felis id metus fermentum laoreet.
      </div>
    </div>
    <!--//app-card-body-->
    <div class="app-card-footer px-4 py-3">
      <a class="action-link" href="#"
        >Read more<svg
          width="1em"
          height="1em"
          viewBox="0 0 16 16"
          class="bi bi-arrow-right ms-2"
          fill="currentColor"
          xmlns="http://www.w3.org/2000/svg"
        >
          <path
            fill-rule="evenodd"
            d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z"
          /></svg
      ></a>
    </div>
    <!--//app-card-footer-->
  </div>
</template>

<script>
export default {};
</script>

<style>
</style>