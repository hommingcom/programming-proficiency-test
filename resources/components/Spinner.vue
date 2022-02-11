<template>
<div>
    <div id="spin"></div>
</div>
</template>

<script>
export default {
  name: 'Spinner',
};
</script>

<style scoped>

#spin {
    height: 80px;
    width: 80px;
    border: 4px solid cyan;
    border-radius: 50%;
    clip-path: polygon(0 0, 0 0, 100% 100%, 0% 100%);
    animation: rotate 1s linear infinite;
}

@keyframes rotate {
    0% {
        clip-path: polygon(50% 0, 25% 0, 100% 100%, 25% 100%);
        transform: rotate(0deg)
    }
    25% {
        clip-path: polygon(25% 0, 50% 0, 100% 100%, 50% 100%);
        transform: rotate(90deg)
    }
    50% {
        clip-path: polygon(50% 0, 100% 0, 100% 100%, 75% 100%);
        transform: rotate(180deg)
    }
    75% {
        clip-path: polygon(75% 0, 75% 0, 100% 100%, 50% 100%);
        transform: rotate(270deg)
    }
    100% {
        clip-path: polygon(50% 0, 25% 0, 100% 100%, 25% 100%);
        transform: rotate(360deg)
    }
}

</style>
