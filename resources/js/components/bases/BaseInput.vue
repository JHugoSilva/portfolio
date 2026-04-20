<script setup>
defineProps({
    label: String,
    modelValue: String,
    type: { type: String, default: "text" },
    hasError: Boolean,
    errorMessage: String,
});

defineEmits(["update:modelValue"]);
</script>
<template>
    <div class="contact_content">
        <label class="contact_label">{{ label }}</label>
        <textarea
            v-if="type === 'textarea'"
            :value="modelValue"
            @input="$emit('update:modelValue', $event.target.value)"
            :class="{ 'error-border': hasError }"
            cols="0"
            rows="7"
            class="contact_input"
        ></textarea>

        <input
            v-else
            :type="type"
            :value="modelValue"
            @input="$emit('update:modelValue', $event.target.value)"
            class="contact_input"
            :class="{ 'error-border': hasError }"
        />
    </div>
    <span v-if="hasError" class="error-msg">{{ errorMessage }}</span>
</template>

<style scoped>
.error-border {
    border: 1px solid red;
}
.error-msg {
    color: red;
    font-size: 0.8rem;
}
</style>
