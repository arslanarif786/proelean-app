<template>
    <div id="description" class="description">
        <h3>About This Gig</h3>
        <p> {{ service.description }} </p>
        <p> {{ service.additional_info }} </p>
    </div>
    <ul class="metadata">
        <li class="metadata-attribute">
        <p>Main Type</p>
        <ul>
            <li> {{ service.category.title }} </li>
        </ul>
        </li>
        <li class="metadata-attribute">
        <p>Image File Format</p>
        <ul>
            <li>JPG</li>
            <li>PNG</li>
            <li>PSD</li>
        </ul>
        </li>
    </ul>
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
