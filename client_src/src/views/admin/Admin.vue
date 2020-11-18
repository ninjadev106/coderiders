<template>
    <v-container class="px-0 pb-0" fluid>
        <router-view></router-view>
    </v-container>
</template>

<style>
.border-top {
    border-top: 1px solid rgba(0, 0, 0, 0.12);
}

.b-total {
    font-size: 1.17em;
    font-weight: bold;
}

.b-tile {
    border-radius: 0;
}

input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
    -webkit-appearance: none;
    margin: 0;
}

input[type="number"] {
    -moz-appearance: textfield;
}
</style>
