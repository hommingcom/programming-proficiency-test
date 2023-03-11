import { shallowMount } from '@vue/test-utils';
import TableProperties from '@/components/TableProperties.vue';
import TablePropertiesFilter from '@/components/TablePropertiesFilter.vue';

it('TableProperties - renders a table', () => {
  const wrapper = shallowMount(TableProperties, {
    propsData: {
      properties: [
        {
          id: 1,
          userId: 1,
          typeId: 1,
          name: 'Penthouse - General Peron 32',
          rentedFrom: new Date(2020, 1, 22),
          rentedTo: new Date(2020, 7, 7),
        },
      ],
    },
  });

  expect(wrapper.find('table').exists()).toBe(true);
});

it('TableProperties - renders a table with 6 columns', () => {
  const wrapper = shallowMount(TableProperties, {
    propsData: {
      properties: [
        {
          id: 1,
          userId: 1,
          typeId: 1,
          name: 'Penthouse - General Peron 32',
          rentedFrom: new Date(2020, 1, 22),
          rentedTo: new Date(2020, 7, 7),
        },
      ],
    },
  });
  expect(wrapper.find('table').findAll('th').length).toBe(8);
});

it('TableProperties - renders a table with the correct data', () => {
  const wrapper = shallowMount(TableProperties, {
    propsData: {
      properties: [
        {
          id: 1,
          userId: 1,
          user: 'Asur Bernardo',
          typeId: 1,
          type: 'home',
          name: 'Penthouse - General Peron 32',
          rentedFrom: new Date(2020, 1, 22),
          rentedFromRedable: '2020-02-22',
          rentedTo: new Date(2020, 7, 7),
          rentedToRedable: '2020-08-07',
          rentedDuration: 6,
          status: null,
        },
      ],
    },
  });

  const table = wrapper.find('table');
  const rows = table.findAll('tr');
  const firstRow = rows.at(2);
  const cells = firstRow.findAll('td');

  expect(cells.at(0).text()).toBe('1');
  expect(cells.at(1).text()).toBe('Asur Bernardo');
  expect(cells.at(2).text()).toBe('home');
  expect(cells.at(3).text()).toBe('Penthouse - General Peron 32');
  expect(cells.at(4).text()).toBe('2020-02-22');
  expect(cells.at(5).text()).toBe('2020-08-07');
  expect(cells.at(6).text()).toBe('6');
  expect(cells.at(7).text()).toBe('');
});

// render a input field
it('TablePropertiesFilter - renders a input field', () => {
  const wrapper = shallowMount(TablePropertiesFilter, {
    propsData: {
      properties: [],
      filterTypes: [],
    },
  });
  expect(wrapper.find('input').exists()).toBe(true);
});

it('TablePropertiesFilter - filter button is working correctly', async () => {
  const wrapper = shallowMount(TablePropertiesFilter, {
    propsData: {
      properties: [
        {
          id: 1,
          userId: 1,
          user: 'Asur Bernardo',
          typeId: 1,
          type: 'home',
          name: 'Penthouse - General Peron 32',
          rentedFrom: new Date(2020, 1, 22),
          rentedFromRedable: '2020-02-22',
          rentedTo: new Date(2020, 7, 7),
          rentedToRedable: '2020-08-07',
          rentedDuration: 6,
          status: null,
        },
      ],
      filterTypes: [{ title: 'User', field: 'user', type: 'checkbox' }],
    },
  });

  const button = wrapper.find('button');
  await button.trigger('click');
  expect(wrapper.find('#filter').isVisible()).toBe(true);
});