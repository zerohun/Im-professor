INSERT INTO universities(name) values("명지대학교");
INSERT INTO majors(university_id,name) values(1, "컴퓨터공학과");
INSERT INTO professors(major_id) values(1);
INSERT INTO professor_infos(professor_id, user_id, major_id,name, photo, content) values(1, 1, 1,"권동섭", "photo.jpg", "정말 정말 좋은 교수님");
INSERT INTO users(major_id, name, email, password) values(1, "오세도", "sedo@sedo.com", "11111");
INSERT INTO votes(professor_id, user_id, prepare, understanding, interest, benefit, hot, comment_text) 
  values(1, 1, 5, 5, 5, 5, 5, "정말 좋은 교수님입니다. 점수도 잘 주시고 잘 가르쳐 주세요.");
