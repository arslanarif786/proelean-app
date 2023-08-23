<template>
    <div id="description" class="description mb-4">
        <h3>{{ $t('service_detail.aboutThisGig') }}</h3>
        <p> {{ service.description }} </p>
        <p> {{ service.additional_info }} </p>
    </div>
</template>

<script>

export default {
    props :{
        service :{
            type: Object,
            require: true
        }
    }
}
</script>
