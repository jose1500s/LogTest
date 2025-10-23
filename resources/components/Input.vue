<script setup>
const props = defineProps({
  modelValue: { type: String, default: '' },
  label: { type: String, default: 'Input' },
  type: { type: String, default: 'text' },
  placeholder: { type: String, default: '' },
  name: { type: String, default: '' },
});

const emit = defineEmits(['update:modelValue']);
</script>

<template>
  <div class="form-floating mb-3">
    <input
      :type="props.type"
      class="form-control"
      :placeholder="props.placeholder"
      :value="props.modelValue"
      :name="props.name"
      @input="emit('update:modelValue', $event.target.value)"
    />
    <label>{{ props.label }}</label>
  </div>
</template>
