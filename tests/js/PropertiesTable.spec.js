import { shallowMount } from '@vue/test-utils';
import PropertiesTable from '@/components/PropertiesTable.vue';

describe('PropertiesTable.vue', () => {
  const users = [
    { id: 1, name: 'Homming Testing One' },
    { id: 2, name: 'Homming Testing Two' },
  ];

  const propertyTypes = [
    { id: 1, name: 'home' },
    { id: 2, name: 'garage' },
    { id: 3, name: 'office' },
  ];

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
      id: 2,
      userId: 2,
      typeId: 1,
      name: 'Flat - Castellana 201',
      rentedFrom: null,
      rentedTo: null,
    },
  ];

  let wrapper;

  beforeEach(() => {
    wrapper = shallowMount(PropertiesTable, {
      propsData: {
        users,
        types: propertyTypes,
        properties,
      },
    });
  });

  it('Component render correctly', () => {
    expect(wrapper.exists()).toBe(true);
  });

  it('renders the correct number of properties', () => {
    const rows = wrapper.findAll('tbody tr');
    expect(rows.length).toBe(properties.length);
  });

  it('renders property names correctly', () => {
    const rows = wrapper.findAll('tbody tr');
    expect(rows.at(0).text()).toContain('Penthouse - General Peron 32');
    expect(rows.at(1).text()).toContain('Flat - Castellana 201');
  });

  it('filters properties by user', async () => {
    await wrapper.setData({ selectedUser: '1' });
    const rows = wrapper.findAll('tbody tr');
    expect(rows.length).toBe(1);
    expect(rows.at(0).text()).toContain('Penthouse - General Peron 32');
  });

  it('filters properties by property type', async () => {
    await wrapper.setData({ selectedType: '1' });
    const rows = wrapper.findAll('tbody tr');
    expect(rows.length).toBe(2);
  });
});
