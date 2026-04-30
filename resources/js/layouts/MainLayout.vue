<template>
    <div class="main-wrapper">
        <slot name="header"></slot>
        <main class="main-content">
            <slot></slot>
        </main>
        <slot name="footer"></slot>
    </div>
</template>
