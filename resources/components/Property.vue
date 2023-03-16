<template>
  <div class='flex flex-row justify-evenly'>
    <td class='py-3 px-6 whitespace-nowrap w-1/3 text-center'>
      <div class='flex items-center'>
        <div class='ml-4'>
          <div class='text-sm font-medium text-gray-900'>
            {{ property.name }}
          </div>
        </div>
      </div>
    </td>
    <td class='py-3 px-6 whitespace-nowrap w-1/3 text-center'>
      <span class='bg-gray-200 text-gray-700 py-1 px-3 rounded-full text-xs'>
        {{ monthsRented(property, timeOffset) }}
      </span>
    </td>
    <td class='py-3 px-6 w-1/3 text-center'>
      <span v-if='checkAvailability(property, timeOffset)'
        class='bg-green-200 text-green-700 py-1 px-3 rounded-full text-xs'
      >
        YES
      </span>
      <span v-else class='bg-red-200 text-red-700 py-1 px-3 rounded-full text-xs'>
        NO
      </span>
    </td>
  </div>
</template>

<script>
export default ({
  name: 'Property',
  props: {
    property: {
      required: true,
    },
  },
  data() {
    return {
      allProperties: [],
    };
  },
  methods: {
    /**
    *  Fetches the list of all properties from the data source.
    *  @return {array} list of all properties from the data source.
    */
    fetchData() {
    },

    /**
    *  Returns the difference in days between param1 and param2.
    *  @param {date} date1 date from which we want to count backwards.
    *  @param {date} date2 reference date to stop counting backwards.
    *  @return {number} difference of days between date1 and date2.
    */
    timeOffset(date1, date2) {
      return Math.ceil(Math.abs(date1 - date2) / (1000 * 60 * 60 * 24));
    },

    /**
    *  Returns the number of months a property has been rented for if possible.
    *  @param {object} property The current case for which the function computes its logic.
    *  @param {function} timeOffset Difference in days between date1 and date2.
    *  @return {number | string} number of months a property has been rented for.
    */
    monthsRented(property, timeOffset) {
      const from = property.rentedFrom ?? 0;
      const to = property.rentedTo ?? 0;
      const today = new Date();

      // Case 1. Property with from and to data.
      if (from !== 0 && to !== 0) return (timeOffset(to, from) / 30).toFixed(2);
      // Case 2. Property with from data.
      if (from !== 0 && to === 0) return (timeOffset(today, from) / 30).toFixed(2);
      // Case 3. Property with no renting history.
      return 'Not rented';
    },

    /**
    *  Returns a boolean to show if the property is available to rent (true) or not (false).
    *  @param {object} property The current case for which the function computes its logic.
    *  @param {function} timeOffset Difference in days between date1 and date2.
    *  @return {boolean} to show if the property is available to rent (true) or not (false).
    */
    checkAvailability(property, timeOffset) {
      const from = property.rentedFrom ?? 0;
      const to = property.rentedTo ?? 0;
      const today = new Date();

      /* One-liner that checks if rentedTo is bigger than rentedFrom AND if there's more than 1 day
      between the rentedTo date and today. */
      return !(to < from) && timeOffset(today, to) > 1;
    },
  },
  mounted() {
    this.fetchData();
  },
});
</script>
