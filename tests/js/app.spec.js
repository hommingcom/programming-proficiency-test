import { shallowMount } from '@vue/test-utils';
import App from '@/App.vue';

describe('App.vue', () => {
  it('is a vue instance', () => {
    const wrapper = shallowMount(App);
    expect(wrapper.isVueInstance()).toBe(true);
  });

  const users = [
    { id: 1, name: 'User 1' },
    { id: 2, name: 'User 2' },
  ];
  const propertyTypes = [
    { id: 1, name: 'Type 1' },
    { id: 2, name: 'Type 2' },
  ];
  const properties = [
    { id: 1, name: 'Property 1', userId: 1, typeId: 1, rentedFrom: '2022-01-01', rentedTo: '2022-01-31' },
    { id: 2, name: 'Property 2', userId: 2, typeId: 2, rentedFrom: '2022-02-01', rentedTo: null },
  ];

  it('renders main component properly', () => {
    const wrapper = shallowMount(Main, {
      data() {
        return {
          users,
          propertyTypes,
          properties,
        };
      },
    });
    expect(wrapper.exists()).toBeTruthy();
  });

  it('filters properties by user correctly', async () => {
    const wrapper = shallowMount(Main, {
      data() {
        return {
          users,
          propertyTypes,
          properties,
          filters: {
            userType: 1,
            propertyType: null,
            startDate: null,
            endDate: null,
          },
        };
      },
    });
    await wrapper.vm.$nextTick();
    expect(wrapper.vm.filteredProperties).toHaveLength(1);
    expect(wrapper.vm.filteredProperties[0].userId).toBe(1);
  });
});
