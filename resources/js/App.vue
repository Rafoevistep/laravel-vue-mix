<template>
    <div class="container">
        <navbar />
    </div>
</template>

<script>
import Navbar from "./components/Navbar";
export default {
    name: "App.vue",
    components : {
        Navbar
    }
}
</script>

<style>
 * {
     margin: 0;
     padding: 0;
     box-sizing: border-box;
 }
</style>
