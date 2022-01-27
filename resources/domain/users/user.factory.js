import User from '@/domain/users/user.model';

export default class UserFactory {
  static buildUserFromApi({ id, name }) {
    return new User(id, name);
  }
}
