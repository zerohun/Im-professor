INSERT INTO universities() values();
INSERT INTO majors(unversity_id) values(1);
INSERT INTO professors(major_id) values(1);
INSERT INTO professor_infos(professor_id, name, photo, content) values(1, "권동섭", "photo.jpg", "정말 정말 좋은 교수님");
INSERT INTO users(major_id, name, email) values(1, "권동섭", "dongseop@gmail.com");
INSERT INTO votes(professor_id, user_id, prepare, understanding, interest, benefit, hot, comment_text) 
  values(1, 1, 5, 5, 5, 5, 5, "정말 좋은 교수님입니다. 점도 잘 주시고 잘 가르쳐 주세요.");
