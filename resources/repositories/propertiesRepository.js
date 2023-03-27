import { properties } from '../mocks/api';

export default {
  getAll() {
    return properties;
  },
  filterByCriteria(criteria) {
    return properties.filter((item) => {
      const typeId = criteria.typeId ? item.typeId === criteria.typeId : true;
      const userId = criteria.userId ? item.userId === criteria.userId : true;
      let rentedTo = false;
      let rentedFrom = false;

      if (criteria.rentedFrom) {
        if (item.rentedFrom) {
          rentedFrom = item.rentedFrom.toDateString() === criteria.rentedFrom.toDateString();
        }
      } else {
        rentedFrom = true;
      }

      if (criteria.rentedTo) {
        if (item.rentedTo) {
          rentedTo = item.rentedTo.toDateString() === criteria.rentedTo.toDateString();
        }
      } else {
        rentedTo = true;
      }

      return (typeId && userId && rentedFrom && rentedTo);
    });
  },
};
