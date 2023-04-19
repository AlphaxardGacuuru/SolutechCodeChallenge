<script setup>
    defineProps(["title", "description", "asignee"]);

</script>

<template>
    <div>
        <h1>{{ title }}</h1>
        <h6>{{ description }}</h6>
        <p>{{ asignee }}</p>
    </div>
</template>
