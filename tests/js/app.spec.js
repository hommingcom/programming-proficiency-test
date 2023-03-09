import { mount, shallowMount } from '@vue/test-utils';
import '@testing-library/jest-dom';
import flushPromises from 'flush-promises';
import App from '@/App.vue';

describe('App.vue', () => {
  it('is a vue instance', () => {
    const wrapper = shallowMount(App);
    expect(wrapper.isVueInstance()).toBe(true);
  });

  it('should be rendered with 7 properties', async () => {
    const wrapper = mount(App);

    await flushPromises();

    const trs = wrapper.findAll('table tbody tr');

    expect(trs.length).toBe(7);
  });

  it('should filter two property by home type', async () => {
    const wrapper = mount(App);

    await flushPromises();
    
    wrapper.find('[data-typeid]').setValue('1');
    wrapper.find('form').trigger('submit.prevent');

    await flushPromises();

    const trs = wrapper.findAll('table tbody tr');

    expect(trs.length).toBe(2);
  });
  it('should filter four property by user', async () => {
    const wrapper = mount(App);

    await flushPromises();
    
    wrapper.find('[data-userid]').setValue('1');
    wrapper.find('form').trigger('submit.prevent');

    await flushPromises();

    const trs = wrapper.findAll('table tbody tr');

    expect(trs.length).toBe(4);
  });
  it('should filter one property by rented from', async () => {
    const wrapper = mount(App);

    await flushPromises();
    
    wrapper.find('[data-rentedfrom]').setValue('2020-02-22');
    wrapper.find('form').trigger('submit.prevent');

    await flushPromises();

    const trs = wrapper.findAll('table tbody tr');

    expect(trs.length).toBe(1);
  });
  it('should filter one property by rented to', async () => {
    const wrapper = mount(App);

    await flushPromises();
    
    wrapper.find('[data-rentedto]').setValue('2020-08-07');
    wrapper.find('form').trigger('submit.prevent');

    await flushPromises();

    const trs = wrapper.findAll('table tbody tr');

    expect(trs.length).toBe(1);
  });
});
