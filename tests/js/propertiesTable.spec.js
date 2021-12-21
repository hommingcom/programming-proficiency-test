import { createLocalVue, shallowMount } from '@vue/test-utils';
import PropertiesTable from '@/components/PropertiesTable.vue';
import VueRouter from 'vue-router';

const localVue = createLocalVue();
localVue.use(VueRouter);
localVue.filter('date', (date) => (date ? date.toLocaleDateString('es-ES', { year: 'numeric', month: '2-digit', day: '2-digit' }) : null));

const properties = [
  {
    id: 1,
    userId: 1,
    typeId: 1,
    name: 'Penthouse - General Peron 32',
    rentedFrom: new Date(2020, 1, 22),
    rentedTo: new Date(2020, 7, 7),
  },
  {
    id: 7,
    userId: 2,
    typeId: 2,
    name: 'Parking - Gran Via 56',
    rentedFrom: new Date(2021, 4, 21),
    rentedTo: null,
  },
];

describe('PropertiesTable.vue', () => {
  it('render properties', () => {
    const wrapper = shallowMount(PropertiesTable, {
      localVue: localVue,
      propsData: {
        properties: properties
      }
    });
    //Include headers row
    expect(wrapper.findAll("tr")).toHaveLength(properties.length + 1);
  });

  it('method isCurrentlyRented works', () => {
    const wrapper = shallowMount(PropertiesTable, {
      localVue: localVue,
      propsData: {
        properties: properties
      }
    });
    expect(wrapper.vm.isCurrentlyRented(properties[0].rentedFrom, properties[0].rentedTo)).toBe(false);
  });

  it('method getMonthsRented works', () => {
    const wrapper = shallowMount(PropertiesTable, {
      localVue: localVue,
      propsData: {
        properties: properties
      }
    });
    expect(wrapper.vm.getMonthsRented(properties[0].rentedFrom, properties[0].rentedTo)).toStrictEqual(7);
  });
});