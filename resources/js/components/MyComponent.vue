<template>
    <button @click="onClick">Click!</button>
</template>

<script lang="ts">
    import * as Vue from "vue";
    import Component from "vue-class-component";

    @Component
    export default class MyComponent extends Base {
        // Initial data can be declared as instance properties
        message: string = "Hello!";

        // Component methods can be declared as instance methods
        onClick(): void {
            window.alert(this.message);
            this.$el.textContent = "some of Me";
        }
    }
</script>
