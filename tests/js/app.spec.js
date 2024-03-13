import { shallowMount, createLocalVue } from '@vue/test-utils';
import VueRouter from 'vue-router';
import App from '@/App.vue';

import { FilterComponent, TableComponent } from '@/components';
import { FormatDate, getDaysRange, Lower, SyncronizeItems } from '@/helpers';

const localVue = createLocalVue();
localVue.use(VueRouter);

describe('App.vue', () => {
  it('is a Vue instance', () => {
    const router = new VueRouter();
    const wrapper = shallowMount(App, { localVue, router });

    expect(wrapper.vm).toBeTruthy();
  });
});

describe('@/components/Filter/FilterComponent.vue', () => {
  it('is a Vue component', () => {
    const wrapper = shallowMount(FilterComponent);

    expect(wrapper.exists()).toBe(true);
  });
});

describe('@/components/Table/TableComponent.vue', () => {
  it('is a Vue component', () => {
    const wrapper = shallowMount(TableComponent);

    expect(wrapper.exists()).toBe(true);
  });
});

describe('@/helpers/FormatDate.js', () => {
  it('returns "-" for empty date', () => {
    const result = FormatDate();
    expect(result).toBe('-');
  });

  it('formats a valid date correctly', () => {
    const validDate = '2024-03-13T12:00:00.000Z';
    const result = FormatDate(validDate);

    const expectedDateRegex = /\d{2}\/\d{2}\/\d{4}/;
    expect(result).toMatch(expectedDateRegex);
  });
});

describe('@/helpers/getDaysRange.js', () => {
  it('returns "-" for empty start date', () => {
    const result = getDaysRange(null, '2024-03-13T12:00:00.000Z');
    expect(result).toBe('-');
  });

  it('returns "Indefinido" for empty end date', () => {
    const result = getDaysRange('2024-03-13T12:00:00.000Z', null);
    expect(result).toBe('Indefinido');
  });

  it('calculates the correct days difference', () => {
    const startDate = '2024-03-10T12:00:00.000Z';
    const endDate = '2024-03-13T12:00:00.000Z';

    const result = getDaysRange(startDate, endDate);

    expect(result).toBe('3 días');
  });

  it('handles 1 day difference correctly', () => {
    const startDate = '2024-03-13T12:00:00.000Z';
    const endDate = '2024-03-14T12:00:00.000Z';

    const result = getDaysRange(startDate, endDate);

    expect(result).toBe('1 Día');
  });
});

describe('@/helpers/Lower.js', () => {
  it('converts a string to lowercase', () => {
    const result = Lower('Hello World');
    expect(result).toBe('hello world');
  });

  it('handles an empty string', () => {
    const result = Lower('');
    expect(result).toBe('');
  });

  it('handles special characters', () => {
    const result = Lower('ThIs Is A tEsT!');
    expect(result).toBe('this is a test!');
  });

  it('handles numbers', () => {
    const result = Lower('123');
    expect(result).toBe('123');
  });

  it('handles null input', () => {
    const result = Lower(null);
    expect(result).toBe(null);
  });

  it('handles undefined input', () => {
    const result = Lower(undefined);
    expect(result).toBe(undefined);
  });
});

describe('@/helpers/SyncronizeItems.js', () => {
  it('synchronizes items correctly', () => {
    const userArray = [
      { id: 1, name: 'User1' },
      { id: 2, name: 'User2' },
    ];

    const propertyTypes = [
      { id: 1, name: 'Type1' },
      { id: 2, name: 'Type2' },
    ];

    const properties = [
      {
        id: 101, userId: 1, typeId: 1, name: 'Property1', rentedFrom: '2024-03-15', rentedTo: '2024-03-20',
      },
      {
        id: 102, userId: 2, typeId: 2, name: 'Property2', rentedFrom: null, rentedTo: null,
      },
    ];

    const synchronizedItems = SyncronizeItems([userArray, propertyTypes, properties]);

    // Ajusta las expectativas según la lógica de tu función y los datos de prueba
    expect(synchronizedItems).toEqual([
      {
        id: 101,
        user_id: 1,
        user_name: 'User1',
        prop_name: 'Property1',
        prop_type: 'Type1',
        rentedFrom: '2024-03-15',
        rentedTo: '2024-03-20',
        status: '<span class="text-red-500">Alquilada</span>',
      },
      {
        id: 102,
        user_id: 2,
        user_name: 'User2',
        prop_name: 'Property2',
        prop_type: 'Type2',
        rentedFrom: null,
        rentedTo: null,
        status: '<span class="text-green-500">Disponible</span>',
      },
    ]);
  });
});