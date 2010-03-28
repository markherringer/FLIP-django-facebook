CREATE TABLE flip_facebook_user (id BIGINT AUTO_INCREMENT, uid BIGINT NOT NULL, last_profile_update_at DATETIME, session_key TEXT NOT NULL, expiration_time DATETIME, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, deleted_at DATETIME, INDEX uid_idx (uid), PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE my_skills (id BIGINT AUTO_INCREMENT, uid BIGINT NOT NULL, deleted_at DATETIME, INDEX uid_idx (uid), PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE rating (id BIGINT AUTO_INCREMENT, uid BIGINT NOT NULL, by_uid BIGINT NOT NULL, skill_id BIGINT NOT NULL, rating VARCHAR(255), created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, deleted_at DATETIME, INDEX uid_idx (uid), INDEX by_uid_idx (by_uid), INDEX skill_id_idx (skill_id), PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE skill (id BIGINT AUTO_INCREMENT, name TEXT NOT NULL, deleted_at DATETIME, PRIMARY KEY(id)) ENGINE = INNODB;
ALTER TABLE flip_facebook_user ADD CONSTRAINT flip_facebook_user_uid_rating_uid FOREIGN KEY (uid) REFERENCES rating(uid);
ALTER TABLE flip_facebook_user ADD CONSTRAINT flip_facebook_user_uid_rating_by_uid FOREIGN KEY (uid) REFERENCES rating(by_uid);
ALTER TABLE my_skills ADD CONSTRAINT my_skills_uid_flip_facebook_user_uid FOREIGN KEY (uid) REFERENCES flip_facebook_user(uid);
ALTER TABLE rating ADD CONSTRAINT rating_skill_id_skill_id FOREIGN KEY (skill_id) REFERENCES skill(id);
