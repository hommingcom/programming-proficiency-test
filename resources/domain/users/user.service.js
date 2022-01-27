import { users } from '@/mocks/api';
import UserFactory from '@/domain/users/user.factory';

export default function getUsers() {
  return new Promise((resolve) => {
    // const users = response.json();
    resolve(users.map((user) => UserFactory.buildUserFromApi(user)));
  });
}
