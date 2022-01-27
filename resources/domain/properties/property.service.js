import { properties, propertyTypes } from '@/mocks/api';
import PropertyFactory from '@/domain/properties/property.factory';
import PropertyTypeFactory from '@/domain/properties/property-type.factory';

export function getProperties() {
  return new Promise((resolve) => {
    // const properties = response.json();
    resolve(properties.map((property) => PropertyFactory.buildPropertyFromApi(property)));
  });
}

export function getPropertyTypes() {
  return new Promise(((resolve) => {
    // const propertyTypes = response.json();
    resolve(propertyTypes.map((type) => PropertyTypeFactory.buildPropertyTypeFromApi(type)));
  }));
}
