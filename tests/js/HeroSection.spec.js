import { shallowMount } from '@vue/test-utils';
import HeroSection from '@/components/HeroSection.vue';

describe('HeroSection.vue', () => {
  it('Component render correctly', () => {
    const wrapper = shallowMount(HeroSection);
    expect(wrapper.exists()).toBe(true);
  });
});
