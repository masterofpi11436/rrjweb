import re

# Sample SQL data (replace with actual data if needed)
old_sql = """
INSERT INTO `user` (`id`, `first_name`, `last_name`, `email`, `password`, `role_id`, `reset_token`, `token_expiry`, `warehouse_role`) VALUES
(27, 'Heather', 'Scott', 'heather.scott@icsolutions.com', '$2y$10$ciRdDHbwqXYnUl0v003TIOQLWmoc.9HTVdVENRv/J9Fjsocm36dYi', 2, NULL, NULL, NULL),
(28, 'Danny', 'Hines', 'danny.hines@icsolutions.com', '$2y$10$ruKyoggOrx8.I/TdNEIZCeo88HfJ/Iowfo7SDUfCpfRqYO72IdZLm', 2, NULL, NULL, NULL),
(29, 'Neil', 'Marlowe', 'nmarlowe@rrjva.org', '$2y$10$RHsXBz0jHo2bUjP5bxcbN.K9gVv54JYifXuq/uVMQNXXJeMmoSopS', 1, NULL, NULL, 9),
(30, 'Charlene', 'Jones', 'jones.charlene@rrjva.org', '$2y$10$/Jlvmc63g6anDRUtKKZWv.6gUlse07GX8PJ72YEErdGVAM9B0W1UG', 4, NULL, NULL, 9),
(34, 'Babette', 'Coleman', 'bcoleman@rrjva.org', '$2y$10$6wgUwYR0azX0O2HJLtTicewXbdbPZSlYCDbQO8PxWOj7xTh/1CGUi', 5, NULL, NULL, 9),
(35, 'Sabrina', 'Whitaker', 'whitaker.sabrina@rrjva.org', '$2y$10$SGYsgLEMu/i3PxMRFJ56/.7WIx69kF8Nmo6hq0GafsoiGp6ShhUVe', 7, NULL, NULL, NULL),
(37, 'Charles', 'Watson', 'watson.charles@rrjva.org', '$2y$10$4sXyqkLp0j9DLKqB53T47ehenA6U4mTz/Lz3dsGD6ZKokwonFm9X6', NULL, NULL, NULL, 8),
(43, 'DeEtta', 'Jones', 'jones.deetta@rrjva.org', '$2y$10$5nK/B9ABA0YLET0DyUyNiuKzBMej3D8WjOBclryoGw21ADVW9pssO', 3, NULL, NULL, 10),
(47, 'Kenyatta', 'Jones', 'jones.kenyatta@rrjva.org', '$2y$10$Atlz4M7aBjIJt/2zUrUcyeY08e8MsWJQtf.bxLGcOQm2ebYsnN1AK', NULL, NULL, NULL, 9),
(48, 'Stacey', 'Dolan', 'dolan.stacey@rrjva.org', '$2y$10$x08VmcRunZYTGQPGAZtXm.5g3Bid4sS5vEGtqgDLi.XZjYWm8PaVi', NULL, NULL, NULL, 9),
(49, 'Tammy', 'Bryant', 'bryant.tammy@rrjva.org', '$2y$10$LGTZ0uKuwFy0m1gbWsv1EOf2Z8oZ1B0.iQKEN9LgIDSe8YHCVOXKC', NULL, NULL, NULL, 9),
(50, 'Latica', 'Scott', 'scott.latica@rrjva.org', '$2y$10$MS41Vpx2ZL0Uh949lhwG4uyj8zBzd538b0EknlkDomUyuh8Ea2Yja', NULL, NULL, NULL, 9),
(51, 'Athena', 'Evans', 'evans.athena@rrjva.org', '$2y$10$37AmHRiaFGf9K/SKTxHhnu6EvtIwswEGqzkAVXLwpAteQOnVxVI4e', NULL, NULL, NULL, 9),
(52, 'Fara', 'Jenkins', 'jenkinsf@rrjva.org', '$2y$10$aggyGCV/sw3F6q5vQ/FcIesG1Ci8k7w7Tw.DmsIJHK1fqsFkHNO8q', NULL, NULL, NULL, 10),
(53, 'Tanette', 'Farmer-Johnson', 'farmer-johnsont@rrjva.org', '$2y$10$8bqwJqH/RxPv3qcPAGw5nO5LWxxpBprRKoZ4WWGw3m8lI6ORULxdW', NULL, NULL, NULL, 10),
(54, 'Te\'Osha', 'Taylor', 'taylor.te\'osha@rrjva.org', '$2y$10$D66N05FPyDPaL3wbMVz0ke5GJZYBmkd411gYgAqJzLfeF/bmRtCZi', NULL, NULL, NULL, 10),
(55, 'Lanasia', 'Mosley', 'mosley.lanasia@rrjva.org', '$2y$10$INxhDCry.lQUURjfiqSrPuQrIQ1jbJgweGzmjPqE5eekVAavrlZ2W', NULL, NULL, NULL, 10),
(56, 'Gloria', 'Yeboah', 'yeboahg@rrjva.org', '$2y$10$.EUu.CClcazuSIvOTxYPSuclSNU/dnqjcnBzvBuLPCQW5CkrZTR1y', NULL, NULL, NULL, 10),
(57, 'Shanel', 'Bond', 'bonds@rrjva.org', '$2y$10$U2hJQBqUuzGu3OfqkgaesOi2BH/Yio7BSpoNcPO10Sj8i80wGeHwO', NULL, NULL, NULL, 10),
(58, 'Tashara', 'Davis', 'davist@rrjva.org', '$2y$10$./Q.brOzDk7trWrqNkfGOOO5dmuBd7RrIx9BUCuXoqbJ9bL3hhY9a', NULL, NULL, NULL, 10),
(59, 'Kayla Tanner', 'Tanner', 'tanner.kayla@rrjva.org', '$2y$10$gIzuwxazHB7EB0V0UZaxAupl66s1nBqcplYuRWXSXpYHSx7ip9xIO', NULL, 'edce6b052be1f928ad952390b376a750b27e8aada1631b8205ffa2a61f2e6827', '2025-02-26 14:11:54', 9),
(60, 'Susan', 'Shelton', 'shelton.susan@rrjva.org', '$2y$10$e4WbpRO7RJKjOlQrFrp2P.kAgktDdYmtZpw7xkFdB4TNUtfYTvZ8i', NULL, NULL, NULL, 10),
(61, 'Nikka', 'Ewing', 'ewingn@rrjva.org', '$2y$10$aD6thyc0R5mKNbvThk49uefXLXbxz3BA6dEZ77BAJphLjqY0duv6S', NULL, NULL, NULL, 10),
(62, 'Sydney', 'Moore', 'mooresl@rrjva.org', '$2y$10$.gfKdDmqlBfHwYJiQbyIue5nmu1Rf0Qyh86gTUQB5/78DUBGUdOei', NULL, NULL, NULL, 10),
(63, 'Chanda', 'Langford', 'langfordc@rrjva.org', '$2y$10$InGni082qF2cj/KYl5niAu3aYXytXeBRvNPUhb2V2Szhx/7NeLGYe', NULL, NULL, NULL, 10),
(64, 'Jasmine', 'Holmes', 'holmesj@rrjva.org', '$2y$10$CvPOgNEsx.1J/HyriQ6t1uiKEM6YjEbrnOXFV3N8OjCFMnFnCVriK', NULL, NULL, NULL, 10),
(65, 'Ruby', 'Jefferson', 'jeffersonr@rrjva.org', '$2y$10$UrRt82y4fXDStfd9ygeHjee.tOYkCIz0UeKiH3Td3RT.XuYU9OKd2', NULL, NULL, NULL, 10),
(66, 'Breanna', 'Fox', 'foxb@rrjva.org', '$2y$10$3B8dH/C5tMAsVEb2HCnzDOxP/1GVg4ft64cUAAbAxAtKca2XyBHC2', NULL, NULL, NULL, 10),
(67, 'Lonnie', 'Feury', 'feury.lonnie@rrjva.org', '$2y$10$EyTTXf1I5NawATDQOI48jenQGQULVln1pdNj17lVtL/uJAMxGHzVC', NULL, NULL, NULL, 9),
(68, 'Mark', 'McDaniel', 'mmcdaniel@rrjva.org', '$2y$10$6EjsOs/lMa1oM19Vn5IhdeZlNgPf3tcCMUtRHeWuYmmf5Nq2Zhjb.', NULL, NULL, NULL, 9),
(69, 'Tim', 'Flexon', 'tflexon@rrjva.org', '$2y$10$cPZSy4jve.zrceOzX95JfOeP0pwp.pbS1boB36yRSzOq1S08mSD.K', NULL, NULL, NULL, 9),
(72, 'Mark', 'Tuggle', 'tugglem@rrjva.org', '$2y$10$NFuC6AzJRxqZPWc7t71sIeGZWRlBfJjYs0olhLR.Cce4aojTI.MOi', 1, '4e4384b524b183fee5946bc49b8421b968f5e8077a2948b0559ca3645f5245af9c0c989847db386a668e29364e2d16c84e44', '2025-04-07 15:57:10', 12),
(73, 'James', 'Stith', 'stith.james@rrjva.org', '$2y$10$EGQ0QTtwotxe9cZ.8WDSPO5vLsCJf7ET522zT/fbEYQVNm9nx3QTK', NULL, NULL, NULL, 9),
(74, 'Alicia', 'Evans', 'evans.alicia@rrjva.org', '$2y$10$XEeIirgQUwmrT2.sJ88AjO02aIU.xi5yvMo7nI5HsY1o2r2EHO3JS', NULL, NULL, NULL, 9),
(75, 'Joseph', 'LaVigne', 'lavigne.joseph@rrjva.org', '$2y$10$2bi1BzM.MjH1ciNaFFnfqeLtaGOnqfxoPlLtoXpPJvCbP89.BFSY6', NULL, NULL, NULL, 9),
(76, 'Princess', 'Fotias', 'fotias.princess@rrjva.org', '$2y$10$HtJSxYwQ9nGxueNa6IQJNucxCXdLHthKqdsniSzh6fKTvFrKCCNmC', NULL, NULL, NULL, 9),
(77, 'Mark', 'Culver', 'culverm@rrjva.org', '$2y$10$DrgbbDQs0QmaM9ooFkJSg.CJHLhALG2ii9ygWpJ1QMGvX1p1/2xEW', NULL, NULL, NULL, 9),
(79, 'Leon', 'Jordan', 'ljordan@rrjva.org', '$2y$10$ubAm.RN5rFe/SdF.QziQou0K1FmkhYOlQPu3fqSCy2RemQ3JbjU3y', NULL, 'dbf8a61f002b72eadeb949cc78cfb942e146e90eed3eb2bb5fef17887e5b19e8386d5c71299d0c0f8d8c666e64939099dcca', '2025-02-04 15:32:24', 9),
(80, 'Jamece', 'Hobbs', 'jhobbs@rrjva.org', '$2y$10$7OOE4xkYCwz3KAIXp4njx.J2egMl7k1hu0eBX8USDtCJr/Cns5xTG', NULL, NULL, NULL, 12),
(81, 'Lynnette', 'Mayes', 'mayes.lynnette@rrjva.org', '$2y$10$7TVZ6kf5qR3zg4fvMEfwze1vd71t1trK0AkOK6bF8q/jssbCmGfz2', NULL, NULL, NULL, 9),
(83, 'Wanda', 'Palmer', 'palmer.wanda@rrjva.org', '$2y$10$4DCBp5YZpWPIdmy7rztLzuSZV.OGrMlmqzm6d2B9wwcISi/3F/G9S', NULL, NULL, NULL, 9),
(84, 'Sabrina', 'Whitaker', 'whitaker.sabrina@rrjva.org', '$2y$10$LmB5VlVl9e5gXQYZG1ZnpOoyEqarrk0XZjmOOydkFnI.EsAchF6D6', NULL, NULL, NULL, 10),
(85, 'Shakalan', 'Trisvan', 'trisvan.shakalan@rrjva.org', '$2y$10$mWVnOPe6QwUd9Oi9ZQ94DeIEzK42BME.IfB6nv70yayTIX9/EDvsa', NULL, NULL, NULL, 9),
(86, 'Laura', 'Reedy', 'reedy.laura@rrjva.org', '$2y$10$Qv9GTTWia72PSvCcFPzX.etAqxfHakMXjL/Q1tmuu2HWq4eB78tIC', NULL, NULL, NULL, 9),
(87, 'Karen', 'Augustus', 'augustus.karen@rrjva.org', '$2y$10$3PHbNdlg0jtyvthVwa3ILeWzGXCpA4U9TQkvCzmLZ7q0TQEvzu.VO', NULL, NULL, NULL, 9),
(88, 'Stacey', 'Saunders', 'saunders.stacey@rrjva.org', '$2y$10$bYg3MIPG8DwuoQPUjuLAi.ij7s5VIN8.IIhrKO/gAu.Wsqcm4zmi2', NULL, NULL, NULL, 10),
(89, 'Taylor', 'Tyrus', 'taylort@rrjva.org', '$2y$10$Ho9nxgi1Xld9VIGbyguLUOmv3ly4CLBS7BPlga3RGCuOE8VwbjYFq', NULL, NULL, NULL, 10),
(90, 'Wendy', 'Higgins', 'higgins.wendy@rrjva.org', '$2y$10$9zR8kfC/X0Gg3G4TgKXkv.z.MPTBAlMXA9XYneRXnUaApGkKPbkT6', NULL, NULL, NULL, 9),
(91, 'Gary', 'Hayes', 'hayes.gary@rrjva.org', '$2y$10$6aeeRS66/eUmT4bblP9Y1OUDBI6ioNaysln0MZ66x5g.v1QvVfFJC', NULL, NULL, NULL, 10),
(92, 'Jonathan', 'Dowdy', 'dowdy.jonathan@rrjva.org', '$2y$10$a3mIt61dsWi/EK2lCmCSNe77izl4cLIjRyuUNvwo5BP0.d890BdQW', NULL, NULL, NULL, 10),
(93, 'Thurman', 'Taylor', 'taylor.thurman@rrjva.org', '$2y$10$S8AHLmm0OcscAm30p1rPcecSMjiPxjT0.8gKeMA3ra6WJ6WD26UwS', NULL, NULL, NULL, 9),
(94, 'Christy', 'Jones', 'jones.christy@rrjva.org', '$2y$10$WTrvHhkUyFRuWIOTiCYAquhQcHYSvq1cPiCQ6dB4f7aDhfSMYXNvK', NULL, NULL, NULL, 10),
(95, 'Franklin', 'Hinson', 'hinsonf@rrjva.org', '$2y$10$lsKRhiEYmisO.RPgWIx8XuwZvOZBQ9mMU66ezbLglW.vhzB32G/7G', NULL, '201b4dfc9a4d13f0d6e172abafcb3bf94639f416bf2a5dfc8f9785b753b87bfa11ec769686c9d0556498787acb61960826fe', '2025-01-21 21:25:37', 10),
(96, 'Markeisha', 'Jones', 'jones.markeisha@rrjva.org', '$2y$10$BlcIrmCIDOQuhuOTlknu1O.vYkpfK./yDbXZ9bYZz7cvwOM5U1mlK', NULL, NULL, NULL, 9),
(97, 'Jose', 'Santos', 'santosj@rrjva.org', '$2y$10$tMwQLJsf/maL6EjOFp0m9e0M5sXnlH7uD7xsTtuRkPdlBBqrVnl1e', NULL, NULL, NULL, 10),
(98, 'Erik', 'Tyson', 'tysone@rrjva.org', '$2y$10$AREHcj68v0PqjhT5rfqeJekrxn9goMGnVAkaYuH2kSF2rYluGhdpe', NULL, NULL, NULL, 10),
(99, 'Clifford', 'davis', 'davisc@rrjva.org', '$2y$10$0zsyd05t64eZ0drKtfI2wO2A4idewZjBK05ecY.8oRu3ESGRySnWS', NULL, NULL, NULL, 10),
(100, 'Ashley', 'Jones', 'jonesa@rrjva.org', '$2y$10$FLkGzXpDLT7Zr5bPZZoFxezV9Ey4BcBqTBGKnOr8CVdF8QHX5reD2', NULL, NULL, NULL, 9),
(101, 'Nathaniel', 'Bonner', 'bonner.nathaniel@rrjva.org', '$2y$10$nUIAU3s9HYJJPiMSMNy2BOmMaWHJ856nevczp8DyFnfvFkEwRFage', NULL, NULL, NULL, 9),
(103, 'Crystal', 'Reid', 'creid@rrjva.org', '$2y$10$MRE3nXVFYkhnuGG7v3g1mOl.yS8hGZ0YYZAYdj4cxiCgjLwAKtTAO', NULL, NULL, NULL, 9),
(104, 'Bonnie', 'Hudson', 'bhudson@rrjva.org', '$2y$10$U5UQIxCckbkcLtOw2l8fmOnyKlTQje4O1sZEj5098JwR0XUZ8WRA2', NULL, NULL, NULL, 10),
(105, 'Sandra', 'Leabough', 'leabough.sandra@rrjva.org', '$2y$10$6yqqpUv24CnXUoEZPQ0hGec3pYtgNrjxYiefiAqWGjDCRmJJWaYc.', NULL, NULL, NULL, 9),
(106, 'Michelle', 'Coleman', 'mcoleman@rrjva.org', '$2y$10$J6MEFVGuk0AGODJfGos4O.g8.wGOLlx2.mKVpdIUibunbi3EBACcm', NULL, NULL, NULL, 9),
(107, 'Maria', 'Montijo', 'mmontijo@rrjva.org', '$2y$10$qBOBnc77PyqyJYgfrys1b.Qf6CzDrBv4zhRzVzBmoB5G6/VLSXDxy', NULL, NULL, NULL, 10),
(108, 'Kimberly', 'Strubel', 'strubel.kimberly@rrjva.org', '$2y$10$fXpLFhJsZud5hEZXZDXKgeWYYL/KKfaDGQnNoah3N/YweqrOZqlvO', NULL, 'c9ca0cccac159ae8611d7b607ac0dfdfd720ef1f34a4d8b3a5434da48a7daaae24a19f33e5d815408b684503aa84b4db9161', '2024-11-08 15:35:57', 10),
(109, 'Anita', 'Bowen', 'bowena@rrjva.org', '$2y$10$nvt1YpNPh1WBUUuDDTEj0eqbjWJrsgbk/qPhlcp070biOOfsLzfEW', NULL, NULL, NULL, 10),
(111, 'Trina', 'McGee', 'mcgeet@rrjva.org', '$2y$10$MgkYEyyguzyBRqgByL2ClOqfA2MHlP8uLZ49lc7qsZyjOFBXEmQ.a', NULL, NULL, NULL, 10),
(112, 'Derrell', 'Baines', 'bainesd@rrjva.org', '$2y$12$VY.QzZSmuUUPKqenl085l.FhBC54RGMFxhwfjbbgfbb9CENT6fSxm', NULL, '3ad157e4800ab85570e2bb12eb97be0ae489946568b52d4e94f4b4349a761368', '2025-03-29 15:30:47', 9),
(113, 'Chester', 'Paluch', 'paluch.chester@rrjva.org', '$2y$10$iKkg5x8QM8caeKsF2tBEeeeRHPVU6OOnJ6tymcGNQlc99IU1wThV6', NULL, NULL, NULL, 9),
(114, 'Michael', 'Ferguson', 'ferguson.michael@rrjva.org', '$2y$10$gG.cuxqMoiJdLr.iuNuOJuTcC767ZUvCUTBCTfqPHaJjZvJDep6hq', NULL, NULL, NULL, 9),
(115, 'Andrew', 'Enos', 'enos.andrew@rrjva.org', '$2y$10$jhSiqMsrfIi8upzUm9/vDe7MUCSnnf/WxUui0jVwElGIN5mvlDh0q', NULL, NULL, NULL, 9),
(116, 'Tyrone', 'Williams', 'williams.tyrone@rrjva.org', '$2y$10$j82TsTlhluVsbitJt1EXgeJTSwZJrW/tXL5OFrKwxQzdLJs/6ujo2', NULL, NULL, NULL, 9),
(117, 'Mark', 'Halpain', 'halpain.mark@rrjva.org', '$2y$10$o81VFZdEmQqg3iXtvnoyWucczGv84TwK1gYZIUGzNFA3irAApw3ua', NULL, NULL, NULL, 9),
(118, 'Demarcus', 'Brown', 'brown.damarcus@rrjva.org', '$2y$10$j.cXHA/CBZPz3MqUsMQjt.sEoQpJ6qQtPrDInrmu1EYBQ1v3YEpBy', NULL, NULL, NULL, 9),
(123, 'Latasha', 'Winston', 'winston.latasha@rrjva.org', '$2y$10$5I6OORd9.TXZCcxMrNR00uZwS2GvyibOunlinKxi5VdccVyn6vxRO', NULL, NULL, NULL, 9),
(124, 'Timothy', 'Gregory', 'gregory.timothy@rrjva.org', '$2y$10$BRL3KLCzlc.2IDn0Ml7E/ujqAOPueDrtNHmqdlg7xSOrZEaZImjEa', NULL, '5d672389d9ec4a85a7dcbafbb6c8fe23090ac8e10e0291a648d97b5f66cd1740f58117688843e19095221a2a59b2a8c2ccbf', '2025-04-07 11:09:34', 9),
(125, 'Steven', 'Bulter', 'butler.steven@rrjva.org', '$2y$10$g9wQkTYGkia0ErCMBvAR5OCVSFJm64Rbwy208H50QbP49k5XBH3e6', NULL, NULL, NULL, 9),
(126, 'Brandon', 'Baines', 'bainesb@rrjva.org', '$2y$10$PTsrqJcVVz8s1yBAW1QGCeDwFOo4v/iRQ6kHa34m19JxSvl1VJui6', NULL, NULL, NULL, 10),
(127, 'Anthony', 'Brown', 'browna@rrjva.org', '$2y$10$rjZOhTSwAlvpGqDKrP52o.BN3y4Gt1EewbwdNEyMR9jFL7doyRUvu', NULL, NULL, NULL, 10),
(128, 'William', 'Lee', 'leew@rrjva.org', '$2y$10$TlsGcW4d832itfl7eBZEOenF3sqHzE.YQVdbh/ZwPaY9dARLxOL9m', NULL, NULL, NULL, 10),
(129, 'John', 'Patterson', 'patterson.john@rrjva.org', '$2y$10$Og2byCj9vRFIj2n7ZJ4hSuJENBHp/Mgqc6ZNacDP8nqow4F9vGexS', NULL, NULL, NULL, 10),
(130, 'Joshua', 'Mayes', 'mayes.joshua@rrjva.org', '$2y$10$bDckgR.0e.GEyd/Ii4HhVulMIzSRZ/OlxlAO5Iegsa9uOIMPs8vRS', NULL, NULL, NULL, 10),
(131, 'Jayson', 'Yerby', 'yerbyj@rrjva.org', '$2y$10$RbNPm/U19WWoix.evxBDW.4TY1FbcR2ISfZkU2BN6FNTvIvXpAZ06', NULL, NULL, NULL, 10),
(132, 'Jason', 'Andrews', 'andrewsj@rrjva.org', '$2y$10$iEohXhSVxBVFtUWoIIg26OggDgPCLySCXYobJsGQFrKkT9Tjf78AC', NULL, NULL, NULL, 10),
(133, 'Bryan', 'Escobar', 'escobarb@rrjva.org', '$2y$10$1XH8.7FHOl8tQlQVJXl5R.SnGnXiY1wT/VBzk09uJB.83SE0OM7eW', NULL, NULL, NULL, 10),
(134, 'Diaiouijus', 'Jesters', 'jestersd@rrjva.org', '$2y$10$3dvSm5PzX.ZQzdajqGYiBObFMEyEJVKHzXGh15iPSUiN59xbRbNy6', NULL, NULL, NULL, 10),
(135, 'Kristona', 'Jones', 'jones.kristonta@rrjva.org', '$2y$10$h7cotIBAnnFfdODXGrgk..HVXju7.CL02Uauu5lPkwE2smf1u.1jW', NULL, NULL, NULL, 9),
(136, 'Jamie', 'Price', 'price.jamie@rrjva.org', '$2y$10$/iWz9wApYrDk4ChZxXm0pe9ZXPvG8GbVwHZ0ieCM1lSnGLeDCoI7m', NULL, NULL, NULL, 9),
(137, 'Shakita', 'Watson', 'watson.shakita@rrjva.org', '$2y$10$ePQ7TQBGUytVyOuhYXJgvuO1B/O3c8fzsIqCc.Xo1UO4r4Ucb4jZC', NULL, NULL, NULL, 10),
(138, 'Nicholas', 'Sample', 'sample.nicholas@rrjva.org', '$2y$10$MB77WHS4pZNuCu1HsvtLQeafJECvO90mpc7lS12sjaHW66WtC4hzS', NULL, NULL, NULL, 9),
(139, 'Lofton', 'Greenway', 'greenway.lofton@rrjva.org', '$2y$10$/XPnc25B/cxqD6rtrO8JXOuuwAxcLZWXX5tTsKg7gd/lGQR2kieRK', NULL, NULL, NULL, 9),
(142, 'Demetria', 'Green', 'demetria.green@rrjva.org', '$2y$10$Lk6h9OIW9II9GXW6Mj2KnumnDqku/4za2LfIhvNFlZVJG1fhPllIi', NULL, NULL, NULL, 9),
(143, 'Charneice', 'Miles', 'milesc@rrjva.org', '$2y$10$6bAG4AIXD6k10fimE7ZT0eLPBY0iIYJGZe0Bhf0xO/36.KiSh4z2.', NULL, NULL, NULL, 10),
(144, 'Courtney', 'Long', 'clong@rrjva.org', '$2y$10$tqsTgHRNf5bMBogxV77PzuLWkrfojKRxKsmpqfh3IDfhOMOnkw5re', NULL, NULL, NULL, 10),
(145, 'Shanae', 'Taylor', 'taylor.shanae@rrjva.org', '$2y$10$QLy8g.aDRsN/CbAkgi6dRevZhNyTEBs0nMGOgsHjwrNVOH2tZmZW6', NULL, NULL, NULL, 10),
(146, 'Denise', 'Ferguson', 'ferguson.denise@rrjva.org', '$2y$10$51X8C7XJ2bny1CQ2RhfE2eaaf3fOkidf12nlA/gr1WMSYMg6mfyTC', NULL, NULL, NULL, 10),
(147, 'Cynthia', 'Jolly', 'jollyc@rrjva.org', '$2y$10$7WXwYcZssIi3o7/Mv8sGI.Q0KpaeRFNX/S3T9kFyBPAhnEHVmFvpa', NULL, NULL, NULL, 10),
(148, 'Brandy', 'Holmes', 'holmes.brandy@rrjva.org', '$2y$10$2PX4uZA9RbbH1hfYp.VuV.coUuU3Nd6aqnMKr1znr.ZgfXsW8H6ry', NULL, NULL, NULL, 10),
(149, 'Brittney', 'Bullock', 'bullockb@rrjva.org', '$2y$10$8krA7P3eusFjvRT.Ll.Xx.fyl8ZAm1Y/0RgYRGPpn3BvaKQiQJxKW', NULL, NULL, NULL, 10),
(150, 'Jevon', 'Dabney', 'dabney.jevon@rrjva.org', '$2y$10$3fsFK.N0jpgqPCKAUfLs3uJU5Jtpb0FlpjwyL9.Yxj3JP7P/Eyay2', NULL, NULL, NULL, 9),
(151, 'Erma', 'Locust', 'elocust@rrjva.org', '$2y$10$jUPl2x./gua0We8cuhsJQuDG.IBz7pqyM5dODPQPVq8Y/aqu.CEj2', NULL, NULL, NULL, 10),
(152, 'Dawn', 'Puryear', 'puryear.dawn@rrjva.org', '$2y$10$VKF/k8w0EHj.POWLS6GT9eK0/dtTS7FkuvlP773I/sGRRg5TS7sCC', NULL, NULL, NULL, 9),
(153, 'Domonique', 'Williams', 'williams.domonique@rrjva.org', '$2y$10$H0Q88k8cZ96gh7BRekXsteNrlm7QoJGEdZQ/emtUhWzK6JBVwmYEy', NULL, NULL, NULL, 9),
(154, 'Nichole', 'Brewton', 'brewton.nichole@rrjva.org', '$2y$10$rssRvDNo888VbHKAT05grucX.V6dZCUHfkC8MIzF3V/RHBGivW/jq', NULL, NULL, NULL, 9),
(155, 'Brittany', 'Nightengale', 'nightengale.brittany@rrjva.org', '$2y$10$xJxiBmzCg93Rbyl7wxE4uuSrXMPV3dlivT91bPcIBRDFSGJzosNWK', NULL, NULL, NULL, 9),
(156, 'Brittney', 'McCauley', 'mccauley.brittney@rrjva.org', '$2y$10$/NWUjyqoFjm8vT/KQUrNpuav0CC6LK2LCBGXciKJlbgrS9nx2XUQG', NULL, NULL, NULL, 9),
(157, 'Cherida', 'Buford', 'buford.cherida@rrjva.org', '$2y$10$o8Ig8OjbsO4dywthP21O7elvYrx20QCfPTCMF05yZ0EvmFCHCK6ci', NULL, NULL, NULL, 10),
(158, 'Raven', 'Nickelberry', 'nickelberry.raven@rrjva.org', '$2y$10$ZxWj2EYHM7eOdfFB/zNc.uFCM/Y6EFrA4ilZXKGxQ.3xlgayyffZ2', NULL, NULL, NULL, 9),
(159, 'Dana', 'Hartsell', 'hartsell.dana@rrjva.org', '$2y$10$b41WKtA2fC/JQ5GVHEgjo.vfTTOviv7cFm4onEPTtNCtKWxSlizuW', NULL, NULL, NULL, 9),
(160, 'Stoney', 'Whirley', 'whirley.stoney@rrjva.org', '$2y$10$Tx4b4FXZQpEscJJpw6cJoOftO3L6dv5zgsukl6xXe5Mzhi6LqE76G', NULL, NULL, NULL, 9),
(161, 'Vicki', 'Turner', 'turner.vicki@rrjva.org', '$2y$10$31FPkjWiTbu6w09XkRL4NudqCab1riEboElBguWiY5Kelr.O62Jsu', NULL, NULL, NULL, 9),
(162, 'Shelia', 'Ward', 'sward@rrjva.org', '$2y$10$.ObcLNiUTzPh7bvC9Vuu5ev6mmAchJkQtd8Emi8bSpfRhhAIrGngm', NULL, NULL, NULL, 10),
(163, 'Lisa', 'Marlowe', 'lmarlowe@rrjva.org', '$2y$10$Fm0SI1tjRec.HM9A9FF9IerB5iQCo5NfE./sQfn0VG9Yo32b/ava6', NULL, NULL, NULL, 9),
(164, 'Shanta', 'Brown', 'brown.shanta@rrjva.org', '$2y$10$HoFVYrn.vTEs1zS0BMgBFusAXO67OH.KhZ1b.BZfPpkLjKpxbNbdy', NULL, NULL, NULL, 9),
(165, 'Viola', 'Spratley', 'spratley.viola@rrjva.org', '$2y$10$06Y2TzYVhEz5/0pe3HtHUOGkRlM3TpHNhS3OPxW7i9K.H1mfSLiRe', NULL, NULL, NULL, 9),
(166, 'Garry', 'Coleman', 'gcoleman@rrjva.org', '$2y$10$yzyOobxUKs8uyRHx8LhqdOABbxxrr1nruQz6OyEKnIdzG9ykUwVlG', NULL, NULL, NULL, 9),
(167, 'Skylar', 'Mayes', 'mayes.skylar@rrjva.org', '$2y$10$DsJEdcxpoQTkjj8vM4p0cutrEDHu6L.AlZnSTL4nlET2eqrfNSbPS', NULL, NULL, NULL, 9),
(169, 'Lezanne', 'Harrison', 'harrison.lezanne@rrjva.org', '$2y$10$27xo.l6k8PiV8f8gp/raxOeFOnAHiOfFTDFMNBU4F7UTOFYxQtlq.', NULL, NULL, NULL, 10),
(170, 'Kelisa', 'Vaughan', 'vaughank@rrjva.org', '$2y$10$8rRSUYyWc6YDJ65D0cbT5eDbv62qg2zTqO2Dn.mE.Yy11uqFyBxX6', NULL, 'a793c1972ab758bb90de55b752262699e3f5d58bbca639b716480a61c236544e402e80e8104ef9df6497208edf6ce1b712b3', '2025-04-10 03:46:04', 10),
(172, 'Linette', 'Fields', 'fieldsl@rrjva.org', '$2y$10$ECbse3jl7Gwl//2sRyenJOInju8rBnHyPyD1E2KwWZlli6ELX5VjO', NULL, NULL, NULL, 10),
(173, 'Mary', 'Bush', 'bushm@rrjva.org', '$2y$10$Hg27VJvSBBk9Bg9ARK0/1OsvxX.Vl9EgCXbOkpDk5TeIy3HXsnYHG', NULL, NULL, NULL, 10),
(174, 'Lakeisha', 'Mason', 'lmason@rrjva.org', '$2y$10$cVQeCfqSC5lOQspbx0u9eu84nkwr82qD7/x0mcgUnYdSVo2xKRAj2', NULL, NULL, NULL, 9),
(175, 'Ms', 'Stokes', 'stokes.candace@rrjva.org', '$2y$10$YHjb9oyRXAAGKoAWsy2DNOrEBBFPXn.xBkCsyL8TwnlqdmY7KW/9e', NULL, NULL, NULL, 10),
(176, 'Ms.', 'Fulton', 'fultonn@rrjva.org', '$2y$10$K7NaK1Wo56eRV1Iadm8eO.pQrPhquYAPvBUpzzkdysbseOYTjt1BG', NULL, NULL, NULL, 12),
(178, 'Miranda', 'Dalton', 'daltonm@rrjva.org', '$2y$10$zOnFLmhofJ0dtWYHOnp2U.jdtVe9fqPOw.koNiA/5IeJlyE7AQ3pq', NULL, NULL, NULL, 10),
(179, 'Steven', 'Reincke', 'reincke.steven@rrjva.org', '$2y$10$IlVoAFlVoID81WdLy91tUOIiZFqoKo8CwFax2WxzY/wlUl/V6XGla', NULL, '1b9e38eea91c8b4f502510de80fad1d2fa7bffc3eda04294f98780b9ed218a20', '2024-09-06 14:16:32', 9),
(180, 'Charles', 'Armstrong', 'carmstrong@rrjva.org', NULL, NULL, 'eba372c3337155f607355e047f1109c2f3ba28f0344e5115c42690dae22cb530', '2024-09-07 14:34:15', 9),
(181, 'Kawan', 'Peterson', 'peterson.kawan@rrjva.org', '$2y$10$FlFl06myZRnJ1ddianGtoeBrfWsuipt7OxaRSOsyotW..gBDn5bl6', NULL, NULL, NULL, 9),
(182, 'Octavia', 'Weaver', 'weavero@rrjva.org', '$2y$10$np6/XiwWD72mxj5N3kuR4.Qu.AI6kfVT/VHFwmZ.GQ8CeF5gCJIim', NULL, NULL, NULL, 10),
(183, 'Jonathan', 'Dix', 'dixj@rrjva.org', '$2y$10$c2rAJMCRzrsH/dJge3bVT.M3fQ8uxtf.3n5u/CZEo7HVYobdgG6qu', NULL, NULL, NULL, 9),
(184, 'Raphael', 'McKelvin', 'mckelvine.raphael@rrjva.org', NULL, NULL, '8088be8765eb34f14bb6fa795c440af8a2437713098aa975537ce94e0131f0aa', '2024-10-10 16:53:24', 9),
(185, 'Earnesto', 'Olds', 'olds.earnesto@rrjva.org', NULL, NULL, '66897f97ca47427522744273be771c721906fa51db8811e82933129b56c8a6dd', '2024-10-12 13:14:12', 10),
(186, 'Bethenia', 'Lundy', 'lundy.bethenia@rrjva.org', '$2y$10$KC4dxYX6svsDiITQzyOblubfm/zBvcTf1PNkVp4./kjMibBeU1UGi', NULL, NULL, NULL, 10),
(187, 'Donald', 'Dailey', 'dailey.donald@rrjva.org', '$2y$10$I2Qik/XPADiFMgG3B7.9kulelrKGTDUQetASfom9uB0jEDZkXVdkq', NULL, NULL, NULL, 10),
(188, 'Michelle', 'Jackson', 'mjackson@rrjva.org', '$2y$10$7baH1GZa49wIV9n9Acl44ePxyuqCnmfp6RQn/fBUWB1S8BeSyTVee', NULL, NULL, NULL, 9),
(189, 'Carl', 'Carbaugh', 'carbaugh.carl@rrjva.org', NULL, NULL, '9dd5ff423aa0984ac886e25640eaa12702f9167a0212a76be151e4a58ab3991b', '2025-01-26 13:26:26', 10),
(190, 'Amara', 'Munford', 'munford.amara@rrjva.org', NULL, NULL, '383806e7494d27a793a2040859c221d58a1f39d9fd96ec4e728ebc38a4fef677', '2025-02-20 19:03:22', 9),
(191, 'Brittani', 'Heare', 'heare.brittani@rrjva.org', NULL, NULL, 'a39dd714efa8cd9b5dd25a2457779292d2c590e20eb878cb7607bb0941ae6250', '2025-03-08 20:43:47', 9),
(192, 'Jeffrey', 'Smith', 'smith.jeffrey@rrjva.org', '$2y$10$Vqgvy487p/GsL.GOFs61l.rgRHqpTMVQyR9KNkWEFHj8BbasdYFDC', NULL, NULL, NULL, 9),
(193, 'Adam', 'Mears', 'mears.adam@rrjva.org', '$2y$10$htin1miEc.kbpoTO1rpi3.qjixqpDlA48Nsf/m.Q0HbkwOMBW7atm', NULL, NULL, NULL, 8);
"""

# Mapping of warehouse_role IDs to ENUM values
role_mapping = {
    "8": "Warehouse Supervisor",
    "9": "Supervisor",
    "10": "Requestor",
    "11": "Warehouse Technician",
    "12": "Property"
}

# Regex pattern to extract first_name, last_name, email, password, warehouse_role
pattern = re.compile(r"\(\d+, '([^']+)', '([^']+)', '([^']+)', ('[^']+'|NULL), .*?, (NULL|\d+)\)", re.DOTALL)

# Build the new SQL query
new_sql = "INSERT INTO `users` (`first_name`, `last_name`, `email`, `password`, `warehouse_role`) VALUES\n"

# Extract and format rows
values = []
matches = pattern.findall(old_sql)  # Extract all matches

if not matches:
    print("No matches found. Check your input format.")

for match in matches:
    first_name, last_name, email, password, warehouse_role = match

    # Handle NULL values
    password = "NULL" if password == "NULL" else password.strip("'")  # Remove quotes if not NULL
    warehouse_role = "NULL" if warehouse_role == "NULL" else f"'{role_mapping.get(warehouse_role, 'NULL')}'"  # Map role ID to ENUM or NULL

    values.append(f"('{first_name}', '{last_name}', '{email}', '{password}', {warehouse_role})")

# Join all values with a comma
if values:
    new_sql += ",\n".join(values) + ";"
else:
    new_sql = "No valid entries found. Please check the input file."

# Output the transformed SQL
print(new_sql)
